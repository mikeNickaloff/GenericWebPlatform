<?php

include_once "database.php";
class Entity {
	var $db;
	var $name;
	var $properties;
	function __construct($entityName) {
		 $this->db = new Database();
		 $this->name = $entityName;
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
		 foreach ($entityProperties as $prop=>$val) {
				$propObj = array();
				$foundtype = gettype($val);
				$propObj[] = $prop;
				$propObj[] = $types_ref[$foundtype];
				//$propObj[$prop] = $types_ref[$foundtype];
				$all_props[] = $propObj;			 	
		}
		 $this->db->create_table("e_".$this->name, $all_props);
		 return $this;
	}
	
}

?>