<?php
include_once "entity.php";
include_once "datawrapper.php";
class DBMember {
	var $info;
	var $entity;
	var $transactions;
	var $changeLogEntity;
	function __construct($memberId) {
		if (!empty($memberId)) {
			$this->entity = new Entity("dbmembers");
			$this->entity->initialize(array("info" => json_encode("[]"), "serialinfo" => "test", "username"=>"something","password"=>"something"));
			$this->entity->id = $memberId;
			$this->entity->fetch($memberId);
			if (isset($this->entity->properties["info"])) {
				$this->info = unserialize($this->entity->properties["info"]);
			}
			//if (!empty($this->entity->properties["info"])) {
			//		$this->info = json_decode($this->entity->properties["info"], true);
			//	} else {
			//	}
			
		}
		return $this;
	}
	public function beginTransaction() {
		$this->transactions = array();
	}
	public function commit() {
		$allChanges = array();
		foreach ($this->transactions as $transaction) {
			/*$arrayObj = array("key"=>$transaction["key"], "from"=>$transaction["from"], "to"=>$transaction["to"]);
			 $allChanges[] = $arrayObj; */
			$this->changeLogEntity = new Entity("changes");
			$this->changeLogEntity->initialize(array("data" => json_encode("{}")));
			//$this->changeLogEntity->assignUUID();
			$this->changeLogEntity->set_property("data", serialize($transaction));
			$this->info[$transaction["key"]] = $transaction["to"];
			$this->changeLogEntity->save();
		}
		//print_r("Saving info as: ".serialize($this->info));
		$this->entity->set_property("info", serialize($this->info));
		$this->entity->set_property("serialinfo", serialize($this->info));
		//	$this->entity->assignUUID();
		$this->entity->save();
	}
	public function changeInfo($infoField, $infoValue) {
		$oldInfo = "not set";
		if (!empty($this->info[$infoField])) {
			$oldInfo = $this->info[$infoField];
		}
		$this->info[$infoField] = $infoValue;
		if ($oldInfo != $infoValue) {
			$changeLogData = array("entity" => "dbmembers", "id" => $this->entity->id, "date" => time(), "column" => "info", "key" => $infoField, "from" => $oldInfo, "to" => $infoValue);
			$this->transactions[] = $changeLogData;
		}
		//print_r(strlen(json_encode($changeLogData)). " !");
		
	}
	public function showMemberProfile() {
		if (!empty($this->info)) {
			$memberWrapper = new DataWrapper(array('beforeKey' => '<p><span>', 'afterKey' => '</span>', 'beforeValue' => '&nbsp;<span>', 'afterValue' => '</span></p>'), $this->info, array("id"=>$this->entity-id));
		}
	}
	public function showMemberEditProfile() {
		if (!empty($this->info)) {
			/*$rv = "<form method='POST' action='/api/save_member_profile.php'>
						<div class='w3-panel w3-card-4 w3-light-gray'>
						<div class='w3-list w3-container w3-bar-block '>"; */
			$rv = "";	
			$rv .= "<input type='hidden' name='memberID' value='".$this->entity->id."' />";
				
			$memberWrapper = new DataWrapper();
			   $rv .= $memberWrapper->render(array(
					'beforeKey' => '	 <div class=" w3-khaki w3-row w3-twothird w3-bordered w3-hover-border-blue-grey w3-bottom-bar"><div class="w3-col w3-third"><span class="  memberviewlabel w3-khaki w3-text-black">', 
					'afterKey' => '</span></div><div class="w3-col w3-half">', 
					'beforeValue' => ' <input type="text" name="{{key}}" class="  w3-input w3-bordered   w3-sand   " value="', 
					'afterValue' => '" /></div></div>'
				),
			   $this->info, array());
			   
			/*$rv .= "</div></div></form>"; */
			return $rv;	
		}
	}
	
	public function set_username($newUser) {
		$this->entity->set_property("username", $newUser);	
	}
	public function set_password($newPass) {
		$this->entity->set_property("password", bin2hex(password_hash($newPass, PASSWORD_DEFAULT)));	
	}
}
?>