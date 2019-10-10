<?php
	
 	$memberObject = new DBMember($_GET["memberId"]);
 	
 	$memberCE = new CustomElement("memberview", array());
 	if ($_SESSION['admin']) {
 		$memberCE->injectText("memberInfo",$memberObject->showMemberEditProfile());
 	} else {
 		$memberCE->injectText("memberInfo","You do not have permission to view/edit member profiles.");
	}
 	
 	$layout->get("main")->injectText("title", "Edit Profile : ".$memberObject->info["First Name"]. " ".$memberObject->info["Last Name"]);
	$layout->get("page")->inject("content", $memberCE);
	$layout->render("main");
?>