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
$sql="select * from user1";
//res 是结果集.mysqli result
$res=$mysqli->query($sql);
//var_dump($res);
//3.处理结果(对应 mysql_fetch_row)
$rows=array();$i=0;
while($row=$res->fetch_assoc()){
		$rows[$i]=$row;
		$i++;
}


echo "<pre>";
	print_r($rows);
echo "</pre>";
//4.关闭资源
//释放内存
$res->free();
//关闭链接
$mysqli->close();

?>