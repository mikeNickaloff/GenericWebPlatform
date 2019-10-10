<?php

$availablePages  = array();
 $pagefiles = glob("./pages/*.php");
	$strip_path = function($url) {
		$newfile = str_replace("./pages/", "", $url);
		$newfile = str_replace(".php", "", $newfile);
		return $newfile;
			
	};
	$availablePages = array_map($strip_path, $pagefiles);
	$pageNames = array();
	foreach  ($availablePages as $idx=>$page) {
		$pageEntity = new Entity("pages", array());
		$pageEntity->initialize(array("url"=>"something", "name"=>"", "metadata"=>"something"));
		$pageEntity->fetch($idx+1);
		$pageEntity->id = $idx+1;
		$name = $pageEntity->get_property("name");
		if (strlen($name) == 0) { $name = $page; $pageEntity->set_property("url", "./pages/".$page.".php"); $pageEntity->set_property("name", $page); $pageEntity->save(); }
		$pageNames[$page] = $name;
		
		
	}
	$pageToNames = array_combine($availablePages, $pageNames);
	print_R(serialize($pageToNames));
	
$pageWrapper = new DataWrapper();
			   $pageWrapperContent = $pageWrapper->render(array(
					'beforeKey' => '	 <div class="w3-padding-small w3-khaki w3-row w3-threequarter w3-bordered w3-hover-border-blue-grey w3-bottom-bar"><div class="w3-col w3-half"><span class="  memberviewlabel w3-khaki w3-text-black">', 
					'afterKey' => '</span></div><div class="w3-col w3-half">', 
					'beforeValue' => ' <input type="text" name="{{key}}" class="  w3-input w3-bordered   w3-sand   " value="', 
					'afterValue' => '" /></div></div>'
				), $pageToNames, array());
$layout->get("page")->injectText("content", $pageWrapperContent);
$layout->render("main");
?>