<?php
include_once $_SERVER['DOCUMENT_ROOT']."/core/autoload.php";
include_once $_SERVER['DOCUMENT_ROOT']."/core/entity.php";

class Document extends Entity {
	var $entity;
	var $id;
	function __construct($documentId = -1) {
		$this->entity = new Entity("documents");
		$this->entity->initialize(array("data"=>json_encode("{}"), "categories"=>json_encode("{}")  ));
		$this->entity->id = $documentId;
		if ($this->entity->id == -1) { 
			$this->entity->assignUUID();
		} else {
			$this->entity->fetch($documentId);
		}
	return $this;	
	}
	
}

?>
