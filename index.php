<?php
include_once $_SERVER['DOCUMENT_ROOT']."/core/autoload.php";	

require_once $_SERVER["DOCUMENT_ROOT"]."/layouts/default.php";

$layout->get("page")->injectText("content", "Welcome to the document warehouse 2.0");
$layout->get("main")->injectText("title", "About");
$layout->render("main");
?>