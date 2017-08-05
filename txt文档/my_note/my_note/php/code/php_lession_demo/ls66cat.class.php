<?php
	class Cat{
		public $name;
		

		//成员方法
		//四则运算
		public function jiSuan($num1,$num2,$oper){
			if($oper=="+"){
				return $num1+$num2;
			}else if($oper=="-"){
				return $num1-$num2;
			}else if($oper=="*"){
				return $num1*$num2;
			}else {
				return $num1/$num2;
			}
		}
		//圆形面积计算
		public function circleArea($radius){
			return $radius*$radius*3.14;
		}
	}
?>