<?php
	$corefiles = glob($_SERVER['DOCUMENT_ROOT']."/core/*.php");
	
	foreach ($corefiles as $idx=>$file) {
		include_once $file;
	}	
	
		$widgetfiles = glob($_SERVER['DOCUMENT_ROOT']."/widgets/*.php");
	
	foreach ($widgetfiles as $idx=>$file) {
		include_once $file;
	}	
	
   
	
?>