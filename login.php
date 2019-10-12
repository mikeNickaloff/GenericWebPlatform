<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/core/entity.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/core/dbmember.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/core/database.php';
		$db = new Database();		
		$data = $db->select("e_dbmembers", array("id","username", "password", "admin"), " where username = ?", array($_POST['usrname']));
		if (sizeof($data) > 0) {
		foreach ($data as $row) {
			foreach ($row as $property => $propValue) {
					if ($property == "password") {
								$enteredPassword = $_POST["psw"];
								$retrievedPassword = hex2bin($propValue);
								$isValid = password_verify($enteredPassword, $retrievedPassword);
							if ($isValid) {
								session_start();
								$_SESSION["memberId"] = $row["id"];
								
									header("location: ".$_POST['redirect']);	
							}			
					}			
			}
	 }
	}
	die("Login failed!");
?>