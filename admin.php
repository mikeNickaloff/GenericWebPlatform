 <?php
 $adminPagefiles = glob("./admin/*.php");
	foreach ($adminPagefiles as $idx=>$file) {
	
		$newfile = str_replace("./admin/", "", $file);
		$newfile = str_replace(".php", "", $newfile);
	
			
	
		if ($newfile == $_GET["page"]) {
			include_once $_SERVER["DOCUMENT_ROOT"]."/core/autoload.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/layouts/default.php"; 
    if ($_SESSION["admin"]) {
			include $_SERVER["DOCUMENT_ROOT"]."/admin/".$newfile.".php";
		} else {
			
			
			}
		}
	
	
	
	}	
	
   
	?>
