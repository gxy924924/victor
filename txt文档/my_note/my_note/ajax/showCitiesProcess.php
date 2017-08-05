<?php
header("content-Type:text/xml;charset=utf-8");
header("Cache-Control:no-cache");

$province=$_POST['province'];//省
//调试中查看接收到的数据
file_put_contents("D:/web/ajax/mylog.txt",$province."\r\n",FILE_APPEND);

$info="";
if($province=="shanxi"){
	$info="<province><city>太原</city><city>运城</city><city>大同</city></province>";
}else if($province=="jiangsu"){
	$info="<province><city>南京</city><city>苏州</city><city>无锡</city></province>";
}
echo $info;

?>