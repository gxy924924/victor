<?php 
header("Content-type: text/html; charset=utf-8"); 

//json测试-----------------------------------------------

// require_once "sqlHelper.class.php";


// $sql=new sqlHelper();
// 	$sql->settable('keyword');
// 	$test=$sql->select();

$test=['a'=>'苹果',"b"=>'banana'];
	$test=json_encode($test);
	// $test= mb_convert_encoding($test,"utf-8","Unicode");
	// $test=urlencode($test);
// 	$base=base64_encode($test[3]['keyword']);
// 	var_dump($test[3]['keyword']);
// 	var_dump($base);
	echo "<pre>";
var_dump($test);
$test=json_decode($test,1);
var_dump($test);
echo "</pre>";


?>