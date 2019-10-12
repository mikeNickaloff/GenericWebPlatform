 <?php
 set_include_path("." . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]."/admin". PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]."/core");
 session_start();
 $adminPagefiles = glob("./admin/*.php");
 //print_r($adminPagefiles);
	foreach ($adminPagefiles as $idx=>$adminfile) {
	
		$adminnewfile = str_replace("./admin/", "", $adminfile);
		$adminnewfile = str_replace(".php", "", $adminnewfile);
	
			
	
		if ($adminnewfile == $_GET["page"]) {
			//include_once $_SERVER["DOCUMENT_ROOT"]."/core/autoload.php";
			
     
    if ($_SESSION["admin"]) {
    	//print_r("FOund admin");
    	include $_SERVER["DOCUMENT_ROOT"]."/layouts/default.php";
    //	print_r("Got layout");
			include $_SERVER["DOCUMENT_ROOT"]."/admin/".$adminnewfile.".php";
			break;
		} else {
			require_once $_SERVER["DOCUMENT_ROOT"]."/layouts/default.php";
			break;
			}
		}
	
	
	
	}	
	
   
	?>
