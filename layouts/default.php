<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/core/autoload.php";
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"] . "/pages" . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"] . "/widgets" . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"] . "/IDS");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/widgets/menu.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/IDS/Init.php");
$layout = new Layout("default");
/* load templates */
$mainCE = new CustomElement("main", array());
$navCE = new CustomElement("navbar", array());
$headingCE = new CustomElement("heading", array());
$pageCE = new CustomElement("page", array());
/* assign positions */
$layout->set("main", $mainCE);
$layout->set("navbar", $navCE);
$layout->set("heading", $headingCE);
$layout->set("page", $pageCE);
/* replace the {{placeholders}} with the custom element in the template */
$layout->get("main")->inject("navbar", $navCE);
$layout->get("heading")->injectText("content", "Document Warehouse v2.0");
$layout->get("main")->inject("heading", $headingCE);
$layout->get("main")->inject("page", $pageCE);
if (isset($_SESSION["admin"])) {
	if ($_SESSION["admin"]) {
		$adminMenuElement = new Menu("admin");
		//$layout->get("navbar")->injectText("admin_menu_header", "Admin Menu");
		$layout->get("navbar")->inject("admin_menu", $adminMenuElement->element);
	}
}
if (isset($_SESSION["memberId"])) {
	$memberMenuElement = new Menu("member");
	//print_r(json_encode($memberMenuElement));
	$layout->get("navbar")->inject("member_menu", $memberMenuElement->element);
	$layout->get("navbar")->injectText("other_menu", '<a href="/logout.php" class="w3-round w3-bar w3-btn w3-hover-white w3-xlarge">Logout</a>');
}
//$layout->render("main");

?>
