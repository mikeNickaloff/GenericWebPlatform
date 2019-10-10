<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]);
include_once $_SERVER["DOCUMENT_ROOT"]."/core/autoload.php";
if (($_SESSION["admin"]) || ($_SESSION["memberId"] == $_POST["memberId"])) {
	$member = new DBMember($_POST["memberId"]);
	$member->beginTransaction();
	foreach ($_POST as $key=>$val) {
		$member->changeInfo(str_replace("_", " ", $key), $val);	
	}
	$member->commit();
	print_r("Success!");	
	
} else {
	print_r("You do not have permission to perform this operation.");	
}
print_r($_POST);

?>