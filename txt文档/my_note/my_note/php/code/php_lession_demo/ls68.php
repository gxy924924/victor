<?php
//析构函数
class Person{
	public $name;
	public $age;
	public function __construct($name,$age){
		$this->name=$name;
		$this->age=$age;
	}
	//写个析构函数--表明销毁顺序
	function __destruct(){
		echo $this->name."销毁资源</br>";
	}
}
/*
$p1=new Person("贾宝玉",16);
$p1=null;
$p2=new Person("林黛玉",18);
$p3=new Person("阿杜",20);
*/

?>
<!--全局变量（小孩玩游戏范例）aaaaaaaaaaaaaaaaaaaaaaaaaa-->
<?php
//声明全局变量
#global $global_num;
//赋初始值
/*$global_num=0;
class Child{
public $name;
function __construct($name){
	$this->name=$name;
}
public function join_game(){
//声明使用global全局变量
global $global_nums;
$global_nums+=1;
	echo $this->name."加入游戏</br>";
}
}

$c1=new Child("李逵");
$c1->join_game();
$c2=new Child("张飞");
$c2->join_game();
$c3=new Child("唐山");
echo "共有".$global_nums."个小孩玩游戏"
*/
?>

<!--静态变量（小孩玩游戏范例）bbbbbbbbbbbbbbbbbbbbbb-->
<?php

class Child{
public $name;
//定义静态变量[static会让空间内放地址而不是值]
public static $nums=0;

function __construct($name){
	$this->name=$name;
}
public function join_game(){
//self::$nums 使用静态变量
self::$nums+=1;
	echo $this->name."加入游戏</br>";
}
}
$c1=new Child("李逵");
$c1->join_game();
$c2=new Child("张飞");
$c2->join_game();
$c3=new Child("唐山");
echo "共有".Child::$nums."个小孩玩游戏"
?>