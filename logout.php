<?php
	session_start();
	unset($_SESSION["memberId"]);
	foreach ($_SESSION as $key=>$val) {
		unset($_SESSION[$key]);
	}
	header("location: /");
?>