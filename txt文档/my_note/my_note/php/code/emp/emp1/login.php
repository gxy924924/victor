<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" >
</head>
<img src="./image/1.png">
<hr/>
<h1>管理员登录系统</h1>
<form action="loginProcess.php" method="post">
<table>
<tr><td>用户id</td><td><input type="text" name="id"
value="<?php require_once 'common.php';getCookieVal("id");?>"></td></tr>

<tr><td>密 &nbsp码</td><td><input type="password" name="password"></td></tr>
<tr><td><input type="text" name="checkCode" size=5px></td><td align="center"><?php getCheckCode(); ?></td></tr>
<tr><td><input type="submit" value="用户登录"></td>
<td><input type="reset" value="重新填写"></td></tr>
<tr><td colspan=2>是否保存用户id(2周)<input type="checkbox" name="keep" value="true" checked="checked"></td></tr>
</table>
</form>


<?php
//接收errno
require_once 'common.php';
if(!empty($_GET['errno'])){
    //根据不同的错误编号，发送错误信息
    errnoReturn($_GET['errno']);
}
?>
<hr/>
<img src="./image/2.png">
</html>
