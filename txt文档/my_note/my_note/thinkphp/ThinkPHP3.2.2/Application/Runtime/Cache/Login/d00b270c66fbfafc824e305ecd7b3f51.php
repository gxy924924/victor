<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf-8">
	<title>login</title>
</head>
<body>
	<h3>用户登陆：</h3>
	<hr>
	<form action="/ThinkPHP3.2.2/index.php/Login/Login/check" method="post">
		<p>用户名：<input type="text" name="username" id=""></p>
		<p>密　码：<input type="text" name="password" id=""></p>
		<p><input type="submit" value="登陆"></p>
	</form>
	<a href="<?php echo U('Login/register');?>">用户注册</a>
</body>
</html>