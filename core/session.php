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
}
?>