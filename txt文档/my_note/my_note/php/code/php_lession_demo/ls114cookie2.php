<?php
header("Content-type:text/html;charset=utf-8");
//获取cookie信息
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";

//获取指定的key对应的值
if(!empty($_COOKIE['name'])){
	$name=$_COOKIE['name'];
	echo "name=".$name;
}else{
	echo "cookie已失效";
}

?>