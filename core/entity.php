<?php
include_once "database.php";
function keyValueToColumnValueArray($iArray) {
	$rv = array();
	foreach ($iArray as $key=>$val) {
		$rv[] = array("column" => $key, "value" => $val);
	}
	return $rv;
}
class Entity {
	var $db;
	var $name;
	var $id;
	var $properties;
	var $uuid;
	function __construct($entityName) {
		$this->db = new Database();
		$this->name = $entityName;
		$this->properties = array();
		return $this;
	}
	public function initialize($entityProperties) {
		$this->properties = $entityProperties;
		$all_props = [];
		$types_ref = array();
		$types_ref["string"] = "text";
		$types_ref["integer"] = "int";
		$types_ref["array"] = "text";
		$types_ref["boolean"] = "bool";
		foreach ($entityProperties as $prop => $val) {
			$propObj = array();
			$foundtype = gettype($val);
			$propObj[] = $prop;
			$propObj[] = $types_ref[$foundtype];
			//$propObj[$prop] = $types_ref[$foundtype];
			$all_props[] = $propObj;
		}
		$this->db->create_table("e_" . $this->name, $all_props);
		$this->assignUUID();
		return $this;
	}
	public function set_property($entityProperty, $propertyValue) {
		$this->properties[$entityProperty] = $propertyValue;
		//print_r("Setting property: ".$entityProperty." to ".$propertyValue);
		
	}
	public function get_property($entityProperty) {
		return $this->properties[$entityProperty];	
	}
	public function save() {
		$this->db->delete("e_" . $this->name, $this->id);
		$propData = keyValueToColumnValueArray($this->properties);
		$this->db = new Database();	
	//	print_r(serialize($propData)); 
		$this->db->insert_multi("e_" . $this->name, $propData);
		
		
	}
	public function fetch($existingEntityID) {
		$colArray = array("*");
		if (count($this->properties) != 0) {
			$colArray = array_keys($this->properties);
		}
		$data = $this->db->select("e_" . $this->name, $colArray, " where id = ? ", array($existingEntityID));
		if (sizeof($data) > 0) {
		foreach ($data as $row) {
			foreach ($row as $property => $propValue) {
				$this->set_property($property, $propValue);
			}
		}
	}
	$this->set_property("id", $existingEntityID);
		$this->id = $existingEntityID;
		//print_r(json_encode($data));
		//print_r("Fetched data for ID: ".$this->id. " ". json_encode($this->properties));
		
	}
	public function fetchBy($column, $value) {
		$colArray = array("*");
		if (count($this->properties) != 0) {
			$colArray = array_keys($this->properties);
			$colArray[] = "id";
		}
		$data = $this->db->select("e_" . $this->name, $colArray, " where ".$column." = ? ", array($value));
		//print_r("Fetchby: ". json_encode($data));
		if (sizeof($data) > 0) {
		foreach ($data as $row) {
			foreach ($row as $property => $propValue) {
				$this->set_property($property, $propValue);
				if ($property == "id") {
					$this->id = $propValue;
				}
			}
		}
	} else {
		
	//	die("Can not find an entity with column: ".$column." = ".$value." in the ".$this->name." table");	
	}
	
		
		//print_r(json_encode($data));
		//print_r("Fetched data for ID: ".$this->id. " ". json_encode($this->properties));
							
	}
	public function assignUUID() {
		$data = $this->db->select("e_" . $this->name, array("max(id)+1 as id"), "", array());
		//print_r("assigning UUID" . $data[0]["id"]);
		
		$this->set_property("id", $data[0]["id"]);
		$this->uuid = $data[0]["id"];
	}
}
?>