<?php
	//我们一个计算  +、-、*、/  的代码集合-》函数

	//1.function 是一个关键字
	//2.jiSuan 函数名（由程序员取名）
	//3.$num1,$num2,$oper 是函数的参数列表（形参）
function jiSuan($num1,$num2,$oper){
	//$res 表示计算结果
	$res=0;
	switch($oper){
		case"+":$res=$num1+$num2;break;
		case"-":$res=$num1-$num2;break;
		case"*":$res=$num1*$num2;break;
		case"/":$res=$num1/$num2;break;
		default:$res=null;echo '不支持此运算符';
	}
	//表示返还结果
	return $res;
}
?>