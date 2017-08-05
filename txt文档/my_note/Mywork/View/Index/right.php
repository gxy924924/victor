<html>
<head>
<meta charset="utf-8">
<title></title>
<style>
body{
	border:1px solid #ccc;
}
</style>
</head>
<body>
	完成功能： </br>
		1.完成iframe视图，菜单开关。</br>
		2.对成员进行数据库查询，删除，修改,增加功能。</br>
		3.对删除、修改功能增加确认功能。</br>
		4.登录功能，登录验证。（登录中有无跳转ajax传值，防止用户名重复）
		5.自动跳转功能。
		注：本网页未使用任何框架、模板引擎，使用自制框架，原生php，只引用了jquery。

	遇到问题：</br>
		1.《frame》不能自制大小，总是跟着屏幕大小变动，故改为用《iframe》。</br>
		2.在left.html中使用show()和hide()有问题，使用fadein/out可以。-》几天后发现是jquery选择器有问题，已修改，现在两种都可用</br>
		3.使用jquery框架不能将confirm的确认功能正常返回，就使用了js-》onclick。</br>
		4.thinkphp的mysql和mysqli库都不好用，试图修改，太过困难，放弃thinkphp。
		5.视图使用smarty，由于smarty过于繁琐，并且发现php有自己的替换（另一种）书写方法，此方法写入html可读性较好，故使用原生php。

</body>
</html>