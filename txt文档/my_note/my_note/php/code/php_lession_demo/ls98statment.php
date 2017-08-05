<?php
header("Content-type: text/html;charset=utf-8");
//预编译(效率较高)
//需求：请使用预处理的方式。向数据库添加三个用户

//1.得到mysqli对象
$mysqli=new MYSQLI("localhost","root","root","test");

if($mysqli->connect_error){
	die($mysqli->connect_error);
}
//2.创建预编译对象
$sql="insert into user1(name,password,email,age) values(?,?,?,?)";
$mysqli_stmt=$mysqli->prepare($sql);
//绑定参数
$name="小倩";
$password="xiaoqian";
$email="aa.sohu.com";
$age="200";
//var_dump($mysqli_stmt);
//参数绑定->给?赋值(第一项是类型，从前往后s代表string，i代表int)这里类型和顺序必须对应
  $mysqli_stmt->bind_param("sssi",$name,$password,$email,$age);
//执行
$b=$mysqli_stmt->execute()or die($mysqli_stmt->error);
//继续添加
$name="老妖";
$password="xiaoqian";
$email="aa.sohu.com";
$age="200";
$mysqli_stmt->bind_param("sssi",$name,$password,$email,$age);
$b=$mysqli_stmt->execute() die($mysqli_stmt->error);
//继续添加
$name="采臣";
$password="xiaoqian";
$email="aa.sohu.com";
$age="200";
$mysqli_stmt->bind_param("sssi",$name,$password,$email,$age);
$b=$mysqli_stmt->execute() die($mysqli_stmt->error);
//3.处理结果
if(!$b){
	//回滚
	die("失败</br>".$mysqli_stmt->error);

}else{
	echo "成功";
}
//关闭资源
$mysqli->close();
?>