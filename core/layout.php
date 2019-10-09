<?php
class Layout {
	var $name;
	var $positions;
	function __construct($layoutName) {
		$this->name = $layoutName;
		//$this->load();
		$this->positions = array();
	}	
	public function load() {
		$filename = $_SERVER['DOCUMENT_ROOT'].'/layouts/'.$this->name.'.php';
		include $filename;
	}
	public function set($layoutPosition, &$element) {
		$this->positions[$layoutPosition] = &$element;
	}
	
	public function get($layoutPosition) {
		if (isset($this->positions[$layoutPosition])) {
			$obj = $this->positions[$layoutPosition]; 
			return $obj;
		} else {
			die("Invalid layout position:  " . $layoutPosition);
		}	
	}
	public function render($layoutPosition) { 
		
		print_r($this->get($layoutPosition)->render());
	}
}
?>