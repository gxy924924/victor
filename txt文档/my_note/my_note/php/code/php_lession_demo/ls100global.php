<?php
header("Content-type: text/html;charset=utf-8");
//全局变量,该变量在整个作用域（此php文件中），都是通用的
$a=23;

function test(){
	//如果希望使用到全局$a
	global $a;
	$a=45;
}

//超全局变量$_SERVER
function test2(){
$_SERVER['hsp']="韩顺平";//会在结果中多一个【hsp】=韩顺平
echo "<pre>";
echo print_r($_SERVER);
echo "<pre>";
}
/*test();
echo $a;

test2();
*/
//超全局变量$_GET
echo "<pre>";
echo print_r($_GET);
echo "</pre>";

//var_dump($_GET);
//echo $_GET['name'];
?>