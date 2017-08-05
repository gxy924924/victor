<?php
//介绍用户名字和密码
$loginUser=$_POST['username'];
$pwd=$_POST['passwd'];
echo "$loginUser"."$pwd";
//判断（因为没有用户表）
if($pwd=="123"){
	//跳转到好友列表
	//echo "</br>ok";
	//把用户名保存到session
	session_start();
	$_SESSION['loginuser']=$loginUser;
	header("location:friendList.php");

}else{
	//不合法
	header("location:login.php");
}
