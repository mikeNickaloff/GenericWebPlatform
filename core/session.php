<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/core/autoload.php";
session_start();
if (!isset($_SESSION["memberId"])) {
		/* never logged in before on device */
		require_once $_SERVER["DOCUMENT_ROOT"]."/layouts/default.php";

		
		
		$sessionCE = new CustomElement("login", array());
		
		$pageCE->inject("content", $sessionCE);
		$sessionCE->injectText("redirect", $_SERVER["REQUEST_URI"]);
		print_r($mainCE->render());
		die();
} else {
	$memberObject = new DBMember($_SESSION["memberId"]);
	if ($memberObject->entity->get_property("admin") == 1) {
		$_SESSION["admin"] = true;
	} else {
		$_SESSION["admin"] = false;	
	}
	print_r($_SESSION);	
}
?>