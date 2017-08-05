<?php
header("Content-type:text/html;charset=utf-8");
session_start();
echo "<h1>购物车商品有</h1>";

foreach($_SESSION as $key =>$val){
	echo "</br>--编号：$key --书名：$val";
}

?>