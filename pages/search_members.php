<?php

$searchCE = new CustomElement("search_members", array());
$layout->get("page")->inject("content", $searchCE);
$layout->get("main")->injectText("title", "Member Search");
$layout->render("main");
?>

<?php
?>