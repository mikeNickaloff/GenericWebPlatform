<?php
	class MenuEditorMenu extends Menu {
		var $menuElement;
		function __construct($menuName) {
			parent::__construct($menuName);
				$this->menuElement = new CustomElement("admin/menu_editor_menu", array());
				$this->menuElement->injectText("menu_title", $this->entity->get_property("title"));
				$this->menuElement->injectText("menu_id", $this->entity->get_property("id"));
				//print_r(serialize($this->menuElement));
				$this->element->injectText("title", $this->menuElement);
				//$this->element->appendText("title", "<ul>");
				$this->element->injectText("items", "<hr />");
				$menuItems = array();
				$menuItems = json_decode($this->entity->get_property("items"), true);
				foreach ($menuItems as $menuItemId => $menuItem) {
					$menuItemElement = new CustomElement("admin/menu_editor_menu_item", array());
					$menuItemElement->injectText("title", $menuItem["title"]);
					$menuItemElement->injectText("url", $menuItem["url"]);
					$menuItemElement->injectText("menu_item_id", $menuItemId);
					$menuItemElement->injectText("menu_id", $this->entity->get_property("id"));
					$this->menuElement->append("items", $menuItemElement);
		}
				return $this;				
		}
		
			
	}

?>