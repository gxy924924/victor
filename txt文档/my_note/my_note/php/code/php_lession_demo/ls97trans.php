<?php
header("Content-type: text/html;charset=utf-8");
//预处理

//1.得到mysqli对象
$mysqli=new MYSQLI("localhost","root","root","test");

if($mysqli->connect_error){
	die($mysqli->connect_error);
}
//将提交设为false(事物一旦提交就不能回滚了)
$mysqli->autocommit(false);
//相当于做了个保存点（savepoint a;）
$sql1="update account set balance=balance-2 where id=1";
$sql2="update account se balance=balance+2 where id=2";

$b2=$mysqli->query($sql2);
$b1=$mysqli->query($sql1);
//3.处理结果
if(!$b1||!$b2){
	//回滚
	echo "失败,回滚</br>".$mysqli->error;
	$mysqli->rollback();
}else{
	echo "成功,提交";
	//提交(一旦提交就没有机会回滚)
	$mysqli->commit();
}
//关闭资源
$mysqli->close();
?>