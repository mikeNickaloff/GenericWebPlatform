<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . "/core/database.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/core/entity.php");
class EntityTable {
	var $entities = array();
	var $entityType;
	
	function __construct($entityName) {
		
		$this->entityType = $entityName;
		$db = new Database();
		$data = $db->select("e_" . $this->entityType, array("id","name","items"), "", array());
		
		if (sizeof($data) > 0) {
			foreach ($data as $row) {
				
				foreach ($row as $property => $propValue) {
					if ($property == "id") {
						$newEntity = new Entity($entityName);
						$newEntity->fetch($propValue);
						$this->entities[] = $newEntity;
					}
				}
			}
		}
		$db->dbConnection->close();
		return $this;
	}
}
?>