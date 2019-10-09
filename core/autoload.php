<?php
	$corefiles = glob($_SERVER['DOCUMENT_ROOT']."/core/*.php");
	
	foreach ($corefiles as $idx=>$file) {
		include_once $file;
	}	
	
   
	
?>