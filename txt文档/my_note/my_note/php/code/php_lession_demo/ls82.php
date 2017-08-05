<!--php异常机制-->
<?php

//定义一个顶级异常处理器
function my_exception($e){
	echo "我是顶级异常处理".$e->getMessage();
}
set_exception_handler("my_exception");

//我们使用异常机制
try{
	addUser("shunping");
	updateUser("Xxx");
}
//catch 捕获 Exception 是异常类（php定义好的一个类）
catch(Exception $e){
	echo "异常信息：".$e->getMessage()."</br>";
	throw $e;
}

function addUser($username){
	if($username=="shunping"){
		//添加ok
	}else{
		//添加error
		//抛出异常,可以理解成返回一个异常
		throw new Exception("添加失败");
	}
}

function updateUser($username){
	if($username=="xiaoming"){}else{
		throw new Exception("更新失败");
	}
}


?>

