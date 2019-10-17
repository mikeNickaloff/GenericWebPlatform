<?php
/*include_once $_SERVER['DOCUMENT_ROOT']."/core/customelement.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/core/layout.php";
	
	include_once $_SERVER['DOCUMENT_ROOT']."/core/session.php"; */
	if (function_exists("theme_path")) {

	} else {
	function theme_path($_file)  {
		$file = str_replace($_SERVER['DOCUMENT_ROOT'], "", $_file);
		if (file_exists($_SERVER['DOCUMENT_ROOT']."/theme/$file")) {
			if (substr($file, 0,1) == "/") {
				return $_SERVER["DOCUMENT_ROOT"]."/theme$file";

			} else {
				return $_SERVER["DOCUMENT_ROOT"]."/theme/$file";

			}
		} else {			if (substr($file, 0,1) == "/") {

				return $_SERVER["DOCUMENT_ROOT"]."$file";
			} else {
				return $_SERVER["DOCUMENT_ROOT"]."/$file";

			}

		}
	}
}
	

	 
	$corefiles = glob($_SERVER['DOCUMENT_ROOT']."/core/*.php");
	
	foreach ($corefiles as $idx=>$file) {
		include_once $file;
	}	
	
	$widgetfiles = glob($_SERVER['DOCUMENT_ROOT']."/widgets/*.php");
	
	foreach ($widgetfiles as $idx=>$file) {
		include_once theme_path($file);
	}	
	
   
	
?>
