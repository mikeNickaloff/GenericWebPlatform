<?php
class CustomElement {
	var $tagName;
	var $contents;
	function __construct($elementTag, $template = null, $templateParams = array()) {
		$this->tagName = $elementTag;
		if ($template != null) {
			
			$myTemplate = new Template($template, $templateParams);
			
			$this->setContent($myTemplate->load());
				
		} else {
			$this->contents = "";
		} 
		return $this;
	}
	function setContent($newContents) {
		$this->contents = $newContents;
	}
	function register() {
	?>
		<script>
			class <?php print_r("ce".$this->tagName); ?> extends HTMLElement {
				constructor() {
					super();
					return this;
				}
				connectedCallback() { 
					this.innerHTML = `<?php print_r($this->contents); ?>`;	
				}
				
			}
			customElements.define(`<?php print_r('ce-'.$this->tagName); ?>`, <?php print_r("ce".$this->tagName); ?>);		
		</script>
	<?php	
	}
}
?>