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
$sql="select id,name,email from user1 where id>?";
$mysqli_stmt=$mysqli->prepare($sql);
$id=5;

//绑定参数
$mysqli_stmt->bind_param("i",$id);
//绑定结果集
$mysqli_stmt->bind_result($id,$name,$email);
$mysqli_stmt->execute();
//取出绑定值
while($mysqli_stmt->fetch()){
	echo "</br>--$id--$name--$email";
}

//var_dump($mysqli_stmt);

//执行

//关闭资源
//释放结果
$mysqli_stmt->free_result();
//关闭预编译语句
$mysqli_stmt->close();
//关闭链接
$mysqli->close();
?>