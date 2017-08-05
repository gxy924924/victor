<?php
header("Content-type: text/html;charset=utf-8");
//批量执行语句

//1.得到mysqli对象
$mysqli=new MYSQLI("localhost","root","root","test");

if($mysqli->connect_error){
	die($mysqli->connect_error);
}

$sqls="insert into user1(name,password,email,age) values('宋江','aaa','aaa@shu.com',45);";
$sqls.="insert into user1(name,password,email,age) values('卢俊义','aaa','aaa@shu.com',45);";
$sqls.="insert into user1(name,password,email,age) values('吴用','aaa','aaa@shu.com',45);";

$b=$mysqli->multi_query($sqls);

if(!$b){
	echo "执行失败".$mysqli->error;
}else{
	echo "OK";
}

//关闭资源
$mysqli->close();
?>