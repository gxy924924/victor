<?php

//mysql扩展库操作mysql数据库步骤如下

//演示对user1表进行增删改的操作
$conn=mysql_connect("127.0.0.1","root","root");
	if(!$conn){
		die("连接失败".mysql_error());
	}

mysql_select_db("test",$conn) or die(mysql_error());

mysql_query("set names utf8");
//4.发送指令sql （ddl 数据定义语句，dml(数据操作语言 update insert,delete),dti 数据事务语句 rollback commit...）
//增=================================
//$sql="insert into user1 (name,password,email,age) values('小明',md5('123456'),'xiaomi@sohu.com',34)";
//删======================================
//$sql="delete from user1 where id=4";
//改======================================
$sql="update user1 set age=100 where id=3";

//发送一条mysql语句 $conn不写会自动找上一个打开的连接
//$res 表示结果集，可以简单地理解就是一张表
//返回值是资源类型
//如果是dml操作，则返回bool值
$res=mysql_query($sql,$conn);

if(!$res){
	echo "操作失败".mysql_error();
}

//看看有几条数据
if(mysql_affected_rows($conn)>0){
	echo "操作成功";
}else{
	echo "没有影响到行数";
}

//6.释放资源，关闭链接。dml操作时返回bool值不需要释放
//mysql_free_result($res);
//关闭链接（可有可无）(写不写都是过一会自己关闭)
mysql_close($conn);
?>

