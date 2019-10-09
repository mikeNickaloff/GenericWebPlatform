<?php
/*  $parameters is:
	example:
		array('beforeKey'=>'<label class="myClass">', 'afterKey'='</label>', 'beforeValue'=>'<span class="someClass">', 'afterValue'=>'</span>')
		
		results in a member profile with
		<label class="myClass"> Key1 </label><span class="someClass">Value 1</span>
		<label class="myClass"> Key2 </label><span class="someClass">Value 2</span>
		<label class="myClass"> Key2 </label><span class="someClass">Value 3</span>
   */
class Datawrapper
{
	   	var $beforeKey;
		var $afterKey;
		var $beforeValue;
		var $afterValue;
		/* $boundValues is an array("tag"=>value) which will force replacement of '{{tag}}' everywhere in the output into `value` */ 
	function __construct() {
		return $this;
	}
	function render($parameters, $arrayData = array(), $boundValues = array()) {
				$paramTargets = array('beforeKey'=>&$this->beforeKey,'afterKey'=>&$this->afterKey,
									 'beforeValue'=>&$this->beforeValue, 'afterValue'=>&$this->afterValue);
									 
		$rv = "";				 
		foreach ($parameters as $paramKey=>$paramVal) {
			
			
			if ($paramKey == 'beforeKey')
				$this->beforeKey = $paramVal;
			if ($paramKey == 'afterKey')
				$this->afterKey = $paramVal;
			if ($paramKey == 'beforeValue')
				$this->beforeValue = $paramVal;
			if ($paramKey == 'afterValue')
				$this->afterValue = $paramVal;
				
			
				//print_r($paramKey. " ".$paramVal. " ".$this->$paramTargets[$paramKey]);  					
				
		}
		foreach ($arrayData as $arrayKey=>$arrayVal) {
			$result = $this->beforeKey.$arrayKey.$this->afterKey.$this->beforeValue.$arrayVal.$this->afterValue;
			$result = str_replace("{{value}}", $arrayVal,$result );
			$result = str_replace("{{key}}", $arrayKey, $result);
			foreach ($boundValues as $tag=>$replacement) {
				$result = str_replace("{{".$tag."}}", $replacement, $result);
				
			}
			$rv .= $result;	
		}	
		
   	return $rv;
	}

	}
?>