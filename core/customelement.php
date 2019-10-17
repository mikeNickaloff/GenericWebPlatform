<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/core/template.php";
class CustomElement {
	var $tagName;
	var $contents;
	var $template;
	var $parameters;
	function __construct($tagName, $templateParams = array()) {
		$this->tagName = $tagName;
		$this->parameters = $templateParams;
		$this->template = new Template($this->tagName, $this->parameters);
		$this->setContent($this->template->load());
		return $this;
	}
	public function setContent($newContents) {
		$this->contents = $newContents;
	}
	public function register() {
		$this->template->register();
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
	            mode: 'open'
	         });
	         sr.appendChild(item.content.cloneNode(true));
	         

	      });

	   }

	}
customElements.define(`<?php print_r('ce-' . $this->tagName); ?>`, <?php print_r("ce" . $this->tagName); ?>);
</script>
	<?php
	}
	/* parameters is array("key"=>"something") where key coincides with
	   {{key}} inside of the template.
	   
	   example:  $this->render()
	   template:  <span> ID Number: <b>{{key}}</b></span>
	   output:    <span> ID Number: <b>25</b></span>
	*/
	public function injectText($key, $val) {
		
			$this->parameters[$key] = $val;
		
	}
	public function appendText($key,$val) {
		if (isset($this->parameters[$key])) {
			$paramType = gettype($this->parameters[$key]);
			if ($paramType == 'array') {
					$newArray = $this->parameters[$key];
					array_push($newArray, $val);
					$this->parameters[$key] = $newArray;	
			} else {
				$newArray = array($this->parameters[$key]);	
				array_push($newArray, $val);
				$this->parameters[$key] = $newArray;
			}
		} else {
			$this->parameters[$key] = $val;
		}	
	}
	public function append($key,&$val) {
		if (isset($this->parameters[$key])) {
			$paramType = gettype($this->parameters[$key]);
			if ($paramType == 'array') {
					$newArray = $this->parameters[$key];
					array_push($newArray, $val);
					$this->parameters[$key] = $newArray;	
			} else {
				$newArray = array($this->parameters[$key]);	
				array_push($newArray, $val);
				$this->parameters[$key] = $newArray;
			}
		} else {
			$this->parameters[$key] = $val;
		}	
	}
	public function inject($key, &$val) {
		$this->parameters[$key] = & $val;
	}
	public function renderWith($parameters) {
		foreach ($parameters as $paramKey => $paramVal) {
			$this->inject($paramKey, $paramVal);
		}
		return $this->template->render($this->expandedParameters());
	}
	public function render() {
		return $this->renderWith(array());
	}
	public function expandedParameters() {
		$result = array();
		foreach ($this->parameters as $paramKey => & $paramVal) {
			$element = $paramVal;
			if (gettype($element) == "object") {
				$classType = get_class($element);
				if ($classType == "CustomElement") {
					$result[$paramKey] = $element->render();
				} else {
					$result[$paramKey] = $element;
				}
			} else {
				if (gettype($element) == "array") {
					foreach ($element as $item) {
						if (gettype($item) == "object") {
							$itemClassType = get_class($item);
							if ($itemClassType == "CustomElement") {
								 $result[$paramKey] .= $item->render();
								
							} else {
								$result[$paramKey] = $item;
							}
						
						} else {
							$result[$paramKey] = $item;
						}
					}
					
				} else {
					
					$result[$paramKey] = $element;
				}
			}
		
		}

			return $result;
	}
}
?>