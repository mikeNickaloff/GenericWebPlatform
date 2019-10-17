<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]);
include_once $_SERVER["DOCUMENT_ROOT"]."/core/autoload.php";
if (($_SESSION["admin"]) || ($_SESSION["memberId"] == $_POST["memberId"])) {
	$member = new User($_POST["memberId"]);
	$member->beginTransaction();
	foreach ($_POST as $key=>$val) {
		$member->changeInfo(str_replace("_", " ", $key), $val);	
	}
	$member->commit();
		
	
} else {
		
}
header("location: ".$_SERVER["HTTP_REFERER"]);


?>
