<?php
header("Content-type: text/html;charset=utf-8");
require_once "ls95mysqli_demo.class.php";

$sqlHelper=new SqlHelper();
$sql="insert into user1(name,password,email,age) values('小红帽姥姥',md5('aaaa'),'xiaomao@sohu.com',80)";
$res=$sqlHelper->execute_dml($sql);
echo "res码：".$res;

?>