<!doctype HTML>
<html><head>
</head><body>
<?php
   include_once './core/database.php';
   include_once './core/entity.php';
   include_once './core/template.php';
   include_once './core/customelement.php';
   
   $db = new Database();
   $db->test();
   //$testEntity = new Entity("Tester3");
   //$testEntity->initialize(array(""=>1, "test2"=>"string"));
print_r("<br>");
  // $db->select("e_Tester3", array("test", "test2"), array("test"=>1)); 
   print_r("<br>");
   //$db->insert_multi("e_Tester3", array(array("column"=>"test", "value"=>1), array("column"=>"test2", "value"=>"string")));
   //$rows = $db->select("e_Tester3", array("test", "test2"), "where test2 = 'string'");
   //print_r(json_encode($rows));
   
   
 //  $db->create_table("users", array( array("username", "text"), array("password", "text") ));
   //$db->execute_query("insert into users(username, password) VALUES(?,?)", array(array("s", "mike"), array("s", md5("bleah1569"))));
  //print_r(serialize($db->execute_query("select * from users where username = ?", array("mike"))));
   //$db->insert_multi("users", array(array("column"=>"username", "value"=>"mike"), array("column"=>"password", "value"=>md5("bleah1569"))));
  /* $navtemplate = new Template("navbar", array());
   $navtemplate->render();
	$maintemplate = new Template("main", array("navbar"=>"", "sitename"=>"mikes web site"));
	$maintemplate->render(); */
	
	$navElement = new CustomElement("navbar", "navbar", array());
	$navElement->register();
	
	$mainElement = new CustomElement("main", "main", array("sitename"=>"mikes web site"));
	$mainElement->register();
	
	$flexElement = new CustomElement("mainflexboxcss", "mainflexboxcss", array());
	$flexElement->register();
	
	
?>
<ce-main></ce-main>
<ce-mainflexboxcss></ce-mainflexboxcss>
<script>

</script>
</body></html>