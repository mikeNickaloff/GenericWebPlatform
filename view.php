 <?php
 	
 $pagefiles = glob("./pages/*.php");
	
	foreach ($pagefiles as $idx=>$file) {
		$newfile = str_replace("./pages/", "", $file);
		$newfile = str_replace(".php", "", $newfile);
		if ($newfile == $_GET["page"]) {
			include_once $_SERVER["DOCUMENT_ROOT"]."/core/autoload.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/layouts/default.php"; 
			include $_SERVER["DOCUMENT_ROOT"]."/pages/".$newfile.".php";
		}
	
	
	
	}	
	
   
	?>
