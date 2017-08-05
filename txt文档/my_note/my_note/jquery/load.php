<?php
header("Content-Type:text/html;charset=utf-8");//json数据用
header("Cache-Control:no-cache");
$username=$_POST["username"];
$password=$_POST["password"];

if($username=="aa" && $password=="bb"){
	echo "yes";
}else{
	echo "no";
}

?>