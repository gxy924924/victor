<!--2016/9/8面向对象编程-->
<?php
//这是一个类
	class Cat{
	//public是一个关键字，目前可以认为$name属性是公开的，可以任意访问。
	public $name;
	public $age;
	public $color;
	}
//创建一个对象（Cat对象）
$cat1=new Cat();
//给某个对象赋值
$cat1->name="小白";
$cat1->age=3;
$cat1->color="白色";
$cat2=new Cat();
$cat2->name="小花";
$cat2->age=100;
$cat2->color="花色";

$findCatName="小白";
if($cat1->name==$findCatName){
	//访问某个对象$对象名->属性名
	//java中的cat1.name不行
	echo $cat1->name."||".$cat1->age."||".$cat1->color;
}

class Person{
	public $height;
	public $age;
	public $weight;
	//....
}
$p1=new Person();
$p1->height=180;
$p1->weight=180;
$p1->age=40;

$p2=new Person();
$p2->height=200;
$p2->weight=130;
$p2->age=50;
?>