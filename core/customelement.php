<?php
class CustomElement {
	var $tagName;
	var $contents;
	var $template;
	function __construct($elementTag, $templateTag = null, $templateParams = array()) {
		$this->tagName = $elementTag;
		if ($templateTag != null) {
			$this->template = new Template($templateTag, $templateParams);
			$this->setContent($this->template->load());
		} else {
			$this->contents = "";
		}
		return $this;
	}
	function setContent($newContents) {
		$this->contents = $newContents;
	}
	function register() {
		$this->template->render();
?>
<script type="text/javascript">
class <?php print_r("ce" . $this->tagName); ?>
	extends HTMLElement {
	   constructor() {
	      super();
	      return this;
	   }
	   connectedCallback() {
	      this.innerHTML = ``;

	      let topLevelThis = this;
	      document.querySelectorAll("#tpl-<?php print_r($this->tagName); ?>").forEach(function(item) {
	         let sr = topLevelThis.attachShadow({
	            mode: 'closed'
	         });
	         sr.appendChild(item.content.cloneNode(true));
	         

	      });

	   }

	}
customElements.define(`<?php print_r('ce-' . $this->tagName); ?>`, <?php print_r("ce" . $this->tagName); ?>);
</script>
	<?php
	}
}
?>