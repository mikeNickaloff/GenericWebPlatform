<?php
/* generates a javascript-based rendering template */
class Template {
	var $parameters;
	var $name;
	var $templateLiteral;
	function __construct($templateName, $templateParameters) {
		$this->name = $templateName;
		$this->parameters = $templateParameters;
		
		$this->templateLiteral = $this->load();
		//print_r($this->templateLiteral);
		return $this;
	}
	function load() {
		$filename = $_SERVER['DOCUMENT_ROOT'].'/templates/'.$this->name.'.tpl';
		return file_get_contents($filename);
	}
	function register() {
		?> 
		<template id="<?php print_r("tpl-".$this->name);?>">
			<?php print_r($this->templateLiteral); ?>
		</template>
		
		<?php
	}
	
	function render($parameters) {
		$result = $this->templateLiteral;
		foreach ($parameters as $key=>$val) {
			$result = str_replace("{{".$key."}}", $val, $result);		
     	} 
     	return $result;
 }
 }
?>