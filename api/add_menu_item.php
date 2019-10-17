<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]);
include_once $_SERVER["DOCUMENT_ROOT"]."/core/autoload.php";
if ($_SESSION['admin'] == 1) {
	$menuEntity = new Entity("menus");
	$menuEntity->fetch(htmlspecialchars($_POST["menu_id"]));

	$items = json_decode($menuEntity->get_property("items"), true);
//	$post_menu_item_id = htmlspecialchars($_POST["menu_item_id"]);
	$menu_item = array();
	$menu_item["url"] = "/index.php";
	$menu_item["title"] = "example menu item";
	$items[] = $menu_item;
	$menuEntity->set_property("items", json_encode($items));
	$menuEntity->save();
	}
	header("location: ".$_SERVER["HTTP_REFERER"]);



?>