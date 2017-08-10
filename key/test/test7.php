<?php 
header("Content-type: text/html; charset=utf-8"); 

//json测试-----------------------------------------------

// require_once "sqlHelper.class.php";
$handler = opendir('./fr/images');
$filename = readdir($handler);
$filename = readdir($handler);
$filename = readdir($handler);

var_dump($filename);


?>