<?php
header("Content-type:text/html;charset=utf-8");
//接收用户购买请求，并把书保存到session中

$bookid=$_GET['bookid'];
$bookname=$_GET['bookname'];

//保存到session中
session_start();
$_SESSION[$bookid]=$bookname;

echo "</br>购买商品成功！";
echo "</br><a href='ls119session_hall.php'>返回购物大厅继续购买</a>";

?>