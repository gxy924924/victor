<?php if (!defined('THINK_PATH')) exit();?><html>
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
		2.对成员进行数据库查询，删除，修改。</br>
		3.对删除、修改功能增加确认功能。</br>

	遇到问题：</br>
		1.frame框架不能自制大小，总是跟着屏幕大小变动，故改为用iframe。</br>
		2.在left.html中使用show()和hide()有问题，使用fadein/out可以。</br>
		3.使用jquery框架不能将confirm的确认功能正常返回，就使用了js。

</body>
</html>