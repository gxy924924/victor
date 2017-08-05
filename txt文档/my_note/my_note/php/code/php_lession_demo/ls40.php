<?php
//三元运算
$a=90;$b=180;
$c=$a>$b?  (12-10):"hello";//$c=true/false? true=.../false=...
echo 'c='.$c;
?><br/>
<?php
//字符串运算
$a="hello world";
$b=123;
$c=$b.$a;//表示内容拼接
echo $c;
?></br>
<?php
//类型运算符
class Dog{}
class Cat{}
//创建一个对象
$cat1=new Cat;
var_dump($cat1 instanceof Cat);
if($cat1 instanceof Cat){
	echo '$cat1 是一只猫';
}
?>