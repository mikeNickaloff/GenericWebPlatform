<?php
	include_once $_SERVER["DOCUMENT_ROOT"]."/core/autoload.php";
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
//print_r(serialize($layout));
	//$layout->render("main");
/* equivalent to using the layout would be doing this: */
/*	
	$mainCE->inject("navbar", $navCE);
	$headingCE->injectText("content","Document Warehouse v2.0");
	$mainCE->inject("heading", $headingCE);
	$mainCE->inject("content", $pageCE); */
	
	
	
	

?>