<?php
header("Content-type:text/html;charset=utf-8");
echo "演示如何读取session";
//1.初始化session
session_start();
//2.读取数据
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
//通过key来取出相应的session
echo "名字是：".$_SESSION['name'];

$arr1=$_SESSION['arr'];
echo "</br>数组的数据：";
foreach($arr1 as $key=>$val){
	echo "&nbsp".$val;
}

class dog{
private $name;
private $age;
private $intro;
	function __construct($name,$age,$intro){
	$this->name=$name;
	$this->age=$age;
	$this->intro=$intro;
	}
	
	public function getName(){
		return $this->name;
	}
}

$xiaogou=$_SESSION['dog'];
echo "</br>狗的名字:".$xiaogou->getName();
/*//2.保存数据
$_SESSION['name']="shunping";
//session文件中可以保存double
//保存 int bool
$_SESSION['age']=8;
$_SESSION['isboy']=true;

//字符串arr
$arr1=array("北京","小明","hello");
$_SESSION['arr']=$arr1;

//保存对象
class dog{
private $name;
private $age;
private $intro;
	function __construct($name,$age,$intro){
	$this->name=$name;
	$this->age=$age;
	$this->intro=$intro;
	}
}
$dog1=new dog("ahuang",5,"good dog");
$_SESSION['dog']=$dog1;
echo "ok";
*/
?>