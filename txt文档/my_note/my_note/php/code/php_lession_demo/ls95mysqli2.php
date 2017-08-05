<?php
header("Content-type: text/html;charset=utf-8");
//mysqli操作mysql数据库（面向对象风格）

//1.创建mysqli 对象
$mysqli=mysqli_connect("localhost","root","root","test");
//验证是否ok
if(!$mysqli){
	die("连接失败".$mysqli_connect_error);
}
//else{echo "success";}
//2.操作数据库（发送sql）
$sql="select * from user1";
//res 是结果集.mysqli result
$res=mysqli_query($mysqli,$sql);
//var_dump($res);
//3.处理结果(对应 mysql_fetch_row)
while($row=mysqli_fetch_row($res)){
	foreach($row as $key=>$val){
		echo "--$val";
	}
	echo "</br>";
}
//4.关闭资源
//释放内存
mysqli_free_result($res);
//关闭链接
mysqli_close($mysqli);

?>