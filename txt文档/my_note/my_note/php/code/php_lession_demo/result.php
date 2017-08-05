<?php
//接受用户从calcu.php(对应静态页面 浏览器)提交的数据

//接收num1的数据
$num1=$_REQUEST['num1'];
//接收num2的数据
$num2=$_REQUEST['num2'];
//接收运算符
$oper=$_REQUEST['oper'];

echo '接收到num1='.$num1.'num2='.$num2.'运算符'.$oper;
echo "</br>";
//var_dump($_POST);
switch($oper){
	case "+":$res=$num1+$num2;break;
	case "-":$res=$num1-$num2;break;
	case "*":$res=$num1*$num2;break;
	case "/":$res=$num1/$num2;break;
}
echo "</br>接收到要求".$num1.$oper.$num2."=".$res;

?>
<a href="calcu.php">返回主页</a>