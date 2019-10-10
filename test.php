
<?php
  // include_once $_SERVER['DOCUMENT_ROOT']."/core/autoload.php";
   
   
   //$testEntity = new Entity("Tester3");
   //$testEntity->initialize(array(""=>1, "test2"=>"string"));

  // $db->select("e_Tester3", array("test", "test2"), array("test"=>1)); 
   //$db->insert_multi("e_Tester3", array(array("column"=>"test", "value"=>1), array("column"=>"test2", "value"=>"string")));
   //$rows = $db->select("e_Tester3", array("test", "test2"), "where test2 = 'string'");
   //print_r(json_encode($rows));
   
   
 //  $db->create_table("users", array( array("username", "text"), array("password", "text") ));
   //$db->execute_query("insert into users(username, password) VALUES(?,?)", array(array("s", "mike"), array("s", md5("bleah1569"))));
  //print_r(serialize($db->execute_query("select * from users where username = ?", array("mike"))));
   //$db->insert_multi("users", array(array("column"=>"username", "value"=>"mike"), array("column"=>"password", "value"=>md5("bleah1569"))));
  /* $navtemplate = new Template("navbar", array());
   $navtemplate->render();
	$maintemplate = new Template("main", array("navbar"=>"", "sitename"=>"mikes web site"));
	$maintemplate->render(); */

include_once "./core/dbmember.php";
			
	$newMember = new DBMember(2);
	//for ($p=0;$p<10;$p++) {
	$newMember->beginTransaction();
	$newMember->changeInfo("First Name", bin2hex(random_bytes(15)));
	$newMember->changeInfo("Last Name", bin2hex(random_bytes(20)));
	$newMember->changeInfo("Street Address", bin2hex(random_bytes(25)));
	$newMember->changeInfo("City", bin2hex(random_bytes(15)));
	$newMember->changeInfo("State", bin2hex(random_bytes(2)));
	$newMember->changeInfo("Zip Code", bin2hex(random_bytes(5)));
	
	$newMember->changeInfo("Phone Number",bin2hex(random_bytes(10)));
	$newMember->commit();
		
	$newMember->set_username("mike");
		$newMember->set_password("test");
	$newMember->entity->save(); 

		
	
	
	$mainCE = new CustomElement("main", array());	
	$navCE = new CustomElement("navbar", array());
	$headingCE = new CustomElement("heading",  array());
	$pageCE = new CustomElement("page", array());	
	$memberCE = new CustomElement("memberview", array());
	$inputField = new CustomElement("inputfield",  array());
	


 	//$memberObject = new DBMember(2);	
		/*$memberObject->set_username("mike");
		$memberObject->set_password("test");
		$memberObject->entity->save(); */
	
	$mainCE->inject("navbar", $navCE);
  
  	$headingCE->injectText("content","Document Warehouse v2.0");

	$mainCE->inject("heading", $headingCE);
	$mainCE->inject("page", $pageCE);
	$pageCE->inject("content", $memberCE);
	
	
	$memberCE->injectText("memberInfo",$memberObject->showMemberEditProfile());	
	
	print_r($mainCE->render());	

?>




	
		<?php


	
//	}
	
	
	
	//$newMember->showMemberEditProfile();
	
	$db = new Database();	
	$changes = $db->select("e_changes", array("data"), "", array());
	
	$totalBytes = 0;
	$fieldsToHighlight = array();
	/*
	foreach ($changes as $row) {
		$transaction = array(); 
		$transaction = unserialize($row["data"]);
		//print_r(json_encode($transaction));
		$totalBytes += strlen($row["data"]);
		
			foreach ($newMember->info as $infoKey=>$infoVal) {
					if ($transaction["entity"] == "dbmembers") {
						if (($transaction["id"] == $newMember->entity->id) && ($transaction["key"] == $infoKey)) {
							if (!in_array($transaction["key"],$fieldsToHighlight)) {
								$fieldsToHighlight[] = $transaction["key"];
							}
								
						}
					}
			}
		//	print_r($transaction["from"]."->".$transaction["to"]);	
		
		
		
		 
		//print_r(serialize($transaction));
	}
	//print_r(json_encode($fieldsToHighlight));
	$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
	print_r("<br> looped change table in ".$time." [Total KB: ".round($totalBytes / 1024)."]");
	
	$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
	//print_r(" ".$time);
*/
?>
	

<script>

</script>

<!--<link href="/css/semantic.css" rel="stylesheet">-->
<?php

   $db->test();
   ?>
