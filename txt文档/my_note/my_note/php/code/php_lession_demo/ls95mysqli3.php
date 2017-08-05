<?php
header("Content-type: text/html;charset=utf-8");
//mysqli操作mysql数据库（面向对象风格）
//1.创建mysqli 对象
$mysqli=new MYSQLI("localhost","root","root","test");
//验证是否ok
if($mysqli->connect_error){
	die("连接失败".$mysqli->connect_error);
}
//else{echo "success";}
//2.操作数据库（发送sql）
//添加
//$sql="insert into user1(name,password,email,age) values('小红帽',md5('aaaa'),'xiaomao@sohu.com',8)";
//删除
$sql="delete from user1 where id=5";

//res 是结果集.mysqli result
$res=$mysqli->query($sql);
//var_dump($res);

//3.处理结果(对应 mysql_fetch_row)
if(!$res){
	echo "操作失败".$mysqli->error;
}else{
	//看看影响了多少行
	if($mysqli->affected_rows>0){echo 'ok';}else{echo "没有受到影响";}
}
//4.关闭资源
//释放内存

//关闭链接


?>