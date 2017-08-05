<?php

//mysql扩展库操作mysql数据库步骤如下


//1.获取连接
$conn=mysql_connect("127.0.0.1","root","root");
	if(!$conn){
		die("连接失败".mysql_error());
	}else{
		echo "成功</br>";
	}
//2.选择数据库
mysql_select_db("test");

//1和2不建议使用建议使用mysqli
/*$conn=mysqli_connect("127.0.0.1","root","root","test");
	if(!$conn){
		die("连接失败".mysql_error());
	}else{
		echo "成功";
	}*/
//3.设置操作编码（建议有）
mysql_query("set names utf-8");
//4.发送指令sql （ddl 数据定义语句，dml(数据操作语言 update insert,delete),dti 数据事务语句 rollback commit...）

$sql="select * from user1";
//发送一条mysql语句 $conn不写会自动找上一个打开的连接
//$res 表示结果集，可以简单地理解就是一张表
//返回值是资源类型
$res=mysql_query($sql,$conn);

//var_dump($res);
//5.接收返回的结果，并处理。
//mysql_fetch_row 会依次取出$res结果集的下一行数据，赋值给$row(数组)
while($row=mysql_fetch_row($res)){
	//第一种取法 取数组$row[]
	//echo "</br>$row[0]--$row[1]--$row[2]--$row[3]";
	//$row是一个数组
	//var_dump($row);
	//第二种取法
	foreach($row as $key => $val){
		echo "--$val";
	}
	echo "</br>";
}
//6.释放资源，关闭链接。
mysql_free_result($res);
//关闭链接（可有可无）(写不写都是过一会自己关闭)
mysql_close($conn);
?>

