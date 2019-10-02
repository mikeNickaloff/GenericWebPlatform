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
	function render() {
		?> 
		<template id="<?php print_r($this->name);?>">
			
		</template>
		<script>
			(function() { 	
				<?php
					foreach ($this->parameters as $param=>$val) {
					 ?>
					  	 let <?php print_r($param); ?> = `<?php print_r($val);?>`;
					  	 
					 <?php
					}
				?>
				
				let templateContents = `<?php print_r($this->templateLiteral); ?>`;			
				document.querySelector("#<?php print_r($this->name);?>").innerHTML = templateContents;							
			})();
		</script>
		<?php
	}
}
?>