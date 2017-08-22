<?php 
header("Content-type: text/xml");
if(empty($_GET['yyyy'])){
	$file="sitemap.xml";
}else{
	$pre_file="./sitemap/";
	$file=$_GET['yyyy']."-".$_GET['mm']."-".$_GET['dd'].".xml";
	$file=$pre_file.$file;
}

// echo "<pre>";
// // var_dump($);
// var_dump($_GET);
// echo "</pre>";
$info=file_get_contents($file);
print_r($info) ;
// loca $file;
?>