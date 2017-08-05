<?php
	header("Content-Type:text/html;charset=utf-8");//json数据用
	header("Cache-Control:no-cache");
	$arr=array(
		"id"=>"11",
		"name"=>"user1",
		"age"=>"30",
		"sex"=>"male"
	);

//	echo "<pre>";
//	print_r($arr);
//	echo "</pre>";
	echo json_encode($arr);
?>