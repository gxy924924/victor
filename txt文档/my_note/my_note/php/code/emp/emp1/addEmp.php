<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<img src="./image/1.png">
<hr/>
<h1>添加雇员</h1>
<?php
echo "<a href='empManage.php?name={$_GET['name']}'>主页</a>";
?>
<form action="empProcess.php?flag=add" method="post">
<table>
<tr><td>名字</td><td><input type="text" name="name"></td></tr>
<tr><td>级别</td><td><input type="text" name="grade"></td></tr>
<tr><td>电邮</td><td><input type="text" name="email"></td></tr>
<tr><td>薪水</td><td><input type="text" name="salary"></td></tr>
<tr><td><input type="submit" value="添加用户"></td>
<td><input type="reset" value="重新填写"></td></tr>
</table>
<hr/>

<hr/>
<img src="./image/2.png">

</html>