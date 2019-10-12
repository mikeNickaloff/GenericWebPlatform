 <?php
 	set_include_path("." . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]."/pages". PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]."/core".PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]."/layouts");
 $apagefiles = glob("./pages/*.php");
 
	
	foreach ($apagefiles as $idx=>$afile) {
		$anewfile = str_replace("./pages/", "", $afile);
		$anewfile = str_replace(".php", "", $anewfile);
		if ($anewfile == $_GET["page"]) {
		//	include_once $_SERVER["DOCUMENT_ROOT"]."/core/autoload.php";
    include $_SERVER["DOCUMENT_ROOT"]."/layouts/default.php"; 
			include $_SERVER["DOCUMENT_ROOT"]."/pages/".$anewfile.".php";
			break;
		}
	
	
	
	}	
	
   
	?>
