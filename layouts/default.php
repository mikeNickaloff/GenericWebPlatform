<?php
	include_once $_SERVER["DOCUMENT_ROOT"]."/core/autoload.php";
	set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]."/pages");
	$layout = new Layout("default");
	
	/* load templates */
	$mainCE = new CustomElement("main", array());	
	$navCE = new CustomElement("navbar", array());
	$headingCE = new CustomElement("heading",  array());
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
		$layout->get("navbar")->injectText("admin_menu_header", "Admin Menu");
		$adminPagefiles = glob("./admin/*.php");

		foreach ($adminPagefiles as $idx=>$file) {
	
			$newfile = str_replace("./admin/", "", $file);
			$newfile = str_replace(".php", "", $newfile);
			$name = $newfile;
			//$name = str_replace('_',' ', $newfile);
			$layout->get("navbar")->appendText("admin_menu_items", '<a href="/admin.php?page='.$newfile.'" class="w3-round w3-bar w3-btn w3-hover-white w3-xlarge">'.$name.'</a>');	
		}
			
		
	} else {
		$layout->get("navbar")->injectText("admin_menu_heading", "");
	}
}
	if (isset($_SESSION["memberId"])) {
		
		$memberPagefiles = glob("./pages/*.php");
		foreach ($memberPagefiles as $idx=>$file) {
	
			$newfile = str_replace("./pages/", "", $file);
			$newfile = str_replace(".php", "", $newfile);
			
			if ((isset($_SESSION["admin"])) && ($_SESSION['admin'])) {
				$tmpMember = new DBMember($_SESSION["memberId"]);
				if ($tmpMember->canViewPage($newfile)) {
					$layout->get("navbar")->appendText("member_menu_items", '<a href="/view.php?page='.$newfile.'" class="w3-round w3-bar w3-btn w3-hover-white w3-xlarge">'.str_replace('_',' ', $newfile).'</a>');
				
				}
			} else {
				$layout->get("navbar")->appendText("member_menu_items", '<a href="/view.php?page='.$newfile.'" class="w3-round w3-bar w3-btn w3-hover-white w3-xlarge">'.str_replace('_',' ', $newfile).'</a>');
			}
				
		}
		
		$layout->get("navbar")->injectText("other_menu_items", '<a href="/logout.php" class="w3-round w3-bar w3-btn w3-hover-white w3-xlarge">Logout</a>');

	} 
//print_r(serialize($layout));
	//$layout->render("main");
/* equivalent to using the layout would be doing this: */
/*	
	$mainCE->inject("navbar", $navCE);
	$headingCE->injectText("content","Document Warehouse v2.0");
	$mainCE->inject("heading", $headingCE);
	$mainCE->inject("content", $pageCE); */
	
	
	
	

?>