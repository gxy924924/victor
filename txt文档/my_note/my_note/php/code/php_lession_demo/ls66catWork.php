<?php
//接收猫类
require_once 'ls66cat.class.php';
//接收网页数据

$doing=$_REQUEST['doing'];

//创建猫
$cat1=new Cat();
//计算
if($doing=="jisuan"){
$num1=$_REQUEST['num1'];
$num2=$_REQUEST['num2'];
$oper=$_REQUEST['oper'];
echo "结果=".$cat1->jiSuan($num1,$num2,$oper);
}else if($doing=="area"){
$radius=$_REQUEST['radius'];
echo "结果=".$cat1->circleArea($radius);
}
?>

</br><a href="ls66catView.php">返回</a>