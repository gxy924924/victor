<?php
	header("Content-Type:text/html;charset=utf-8");//json数据用
	header("Cache-Control:no-cache");
	$id=$_POST['id'];
	$arr=array("a.png","b.png");
	echo "<img src='{$arr[$id]}'>";
?>