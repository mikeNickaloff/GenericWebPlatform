<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]);
include_once $_SERVER["DOCUMENT_ROOT"]."/core/autoload.php";
$menuEntity = new Entity("menus");
$menuEntity->fetch($_POST["menu_id"]);

$items = json_decode($menuEntity->get_property("items"), true);
$post_menu_item_id = $_POST["menu_item_id"];
$menu_item = $items[$post_menu_item_id];
$menu_item["title"] = $_POST["title"];
$menu_item["url"] = $_POST["url"];
$items[$post_menu_item_id] = $menu_item;
$menuEntity->set_property("items", json_encode($items));
$menuEntity->save();
header("location: ".$_SERVER["HTTP_REFERER"]);


?>