<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div id="container" class="flexChild rowParent">

  <div id="navbar" class="flexChild"><ce-navbar  /></div>

  <div id="page" class="flexChild selected w3-main w3-container" style="left-margin: 25%">
  
  <div><slot name="page-heading" /></div>

<div><slot name="page-content" /></div>



</div>

<link href="/css/w3.css" rel="stylesheet">
<link href="/css/main.css" rel="stylesheet">
<style>

</style>
</body>


</html>