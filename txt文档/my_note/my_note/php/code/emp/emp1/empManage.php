<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
</head>
<img src="./image/1.png">
<hr/>
<?php
require_once 'common.php';
checkUserValidate();
echo "欢迎你".$_SESSION['name'].",登录成功</br>";
//来自common.php 显示上次登录时间
lastVisitTime();
echo "</br>";
echo "<a href='login.php'>退出</a> 
    <h1>主界面</h1>
    <a href='empList.php?'>管理用户</a><br/>
    <a href='addEmp.php?'>添加用户</a><br/>
    <a href='empList.php?name='>查询用户</a><br/>
    <a href='login.php'>退出系统</a><br/>";

?>

<hr/>
<img src="./image/2.png">
</html>