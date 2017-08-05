<?php
header('Content-type:text/html; charset=UTF-8');
require_once "sqlTool.class.php";
$sqltool=new sqlTool();
/*//添加操作(user1)---------------------------------------------
$sql="insert into user1 (id,name,password,email,age) values('4','小明',md5('123456'),'xiaomi@sohu.com',34)";
$sqltool=new sqlTool();
$sqltool->execute_dml($sql);
//--------------------------------------------------------*/
//添加操作(words)---------------------------------------------
//$sql="update words set chword=学校 where id=1;";

//$sqltool->execute_dml($sql);
//查--------------------------------------------------------
$sql="select * from user1;";


$sqltool->execute_dql("words");
//mysql_fetch_field函数使用(可显示表头信息)
/*（可输入：name - 列名 
table - 该列所在的表名 
max_length - 该列最大长度 
type - 该列的类型 ...等*/
//$sqltool->execute_fetch_field('name');
//$row=$sqltool->execute_row("user1");
//echo $row;
//$col=$sqltool->execute_colms("user1");
//echo $col;
//以表格的样式打印出数据
//$sqltool->execute_table("user1");


?>

