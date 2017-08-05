<?php
header("content-Type:text/html;charset=utf-8");
header("Cache-Control:no-cache");

$cities=$_POST["city"];

//随机生成 3个500-2000的数
$res='[';
for($i=0;$i<count($cities);$i++){
	if($i==count($cities)-1){
		$res.='{"price":"'.rand(500,1500).'"}]';
	}else{
		$res.='{"price":"'.rand(500,1500).'"},';
	}
}
file_put_contents("mylog.txt",$res."\r\n",FILE_APPEND);

echo $res;

?>