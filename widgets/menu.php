<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/layouts/default.php";
class Menu {
	var $entity;
	var $name;
	var $id;
	var $element;
	function __construct($menuName) {
		$this->entity = new Entity("menus");
		$this->entity->initialize(array("name" => "somename", "items" => json_encode("{}"), "title" => "sometitle"));
		$this->entity->fetchBy("name", $menuName);
		$this->id = $this->entity->id;
		if (gettype(json_decode($this->entity->get_property("items"), true)) != "array") {
			$defaultMenuItems = array();
			$menuSearchFolder = "";
			$menuBaseURL = "";
			if ($menuName == "admin") {
				$menuSearchFolder = "admin";
				$menuBaseURL = "/admin.php?page=";
			} else {
				$menuSearchFolder = "pages";
				$menuBaseURL = "/view.php?page=";
			}
			$menuSearchFiles = glob("./" . $menuSearchFolder . "/*.php");
			foreach ($menuSearchFiles as $idx => $file) {
				$newfile = str_replace("./" . $menuSearchFolder . "/", "", $file);
				$newfile = str_replace(".php", "", $newfile);
				$menuNewItem = array("title" => str_replace('_', ' ', $newfile), "url" => $menuBaseURL . $newfile);
				$defaultMenuItems[] = $menuNewItem;
			}
			$this->entity->set_property("items", json_encode($defaultMenuItems));
			$this->entity->set_property("name", $menuName);
			$this->entity->set_property("title", $menuName);
			$this->entity->save();
		}
		$this->element = new CustomElement("menu");
		$menuItems = array();
		$menuItems = json_decode($this->entity->get_property("items"), true);
		foreach ($menuItems as $menuItemId => $menuItem) {
			$menuElement = new CustomElement("menu_item", array());
			$menuElement->injectText("title", $menuItem["title"]);
			$menuElement->injectText("url", $menuItem["url"]);
			$this->element->append("items", $menuElement);
		}
		$this->element->injectText("title", $this->entity->get_property("title"));
		return $this;
	}
}
?> 
