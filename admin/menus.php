<?php
	include_once $_SERVER["DOCUMENT_ROOT"]."/admin/widgets/menu_editor_menu.php";
 	$menuTable = new EntityTable("menus");
 	$menuData = array();
 	foreach ($menuTable->entities as $entity) {
 		
 		$menuData[$entity->get_property("name")] = $entity->get_property("items");
 	}
 	foreach ($menuData as $menuName=>$menuItems) {
 		$menuElement = new MenuEditorMenu($menuName);
 		$layout->get("page")->append("content", $menuElement->element);
	}
	$layout->get("main")->injectText("title", "Edit Menus");
 	
 	
 	$layout->render("main");
 ?>