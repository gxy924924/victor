<?php 
header("Content-type: text/html; charset=utf-8"); 

//server-----------------------------------------------
$page_url=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];


echo "<pre>";
var_dump($page_url);
var_dump($_SERVER);
echo "</pre>";



?>