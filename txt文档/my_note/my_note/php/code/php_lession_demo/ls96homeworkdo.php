<?php
header("Content-type: text/html;charset=utf-8");
//mysqli操作mysql数据库（面向对象风格）
//1.创建mysqli 对象
$mysqli=new MYSQLI("localhost","root","root","test");
//验证是否ok
if($mysqli->connect_error){
	die("连接失败".$mysqli->connect_error);
}
$mysqli->query("set names utf-8");
//2.根据不同的页面给出不同的处理
$sendtype=$_REQUEST['sendtype'];
echo "页码".$sendtype."</br>";
//页码1
if($sendtype==1){
	$search=$_REQUEST['search'];
	$sql="select * from news where content like '%".$search."%'";
	$res=$mysqli->query($sql);
	if($res->num_rows==0){echo "查询为空";}else{
	echo "<table border=1px><tr>";
	while($finfo=$res->fetch_field()){
		echo "<td>".$finfo->name."</td>";
	}echo "</tr>";
	while($row=$res->fetch_row()){
		echo "<tr>";
		foreach($row as $key=>$val){
			echo "<td>".$val."</td>";
		}
		echo "</tr>";
	}echo "</table>";
	}
}
//页码2
else if($sendtype==2){
	$title=$_REQUEST['title'];
	$content=$_REQUEST['content'];
	$datetime=$_REQUEST['datetime'];
	$sql="insert into news(title,content,pubdate) values('".$title."','".$content."','".$datetime."')";
	$res=$mysqli->query($sql);
	//3.处理结果(对应 mysql_fetch_row)
if(!$res){
	echo "操作失败".$mysqli->error;
}else{
	//看看影响了多少行
	if($mysqli->affected_rows>0){echo 'ok';}else{echo "没有受到影响";}
}
}

?>