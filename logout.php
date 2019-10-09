<?php
	session_start();
	unset($_SESSION["memberId"]);
	header("location: /");
?>