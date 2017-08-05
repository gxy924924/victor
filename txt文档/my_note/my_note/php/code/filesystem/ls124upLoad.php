<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<title>上传文件</title>
</head>

<body>
<div>
ls124upLoadprocess.php
	<form enctype="multipart/form-data" method="post" action="http://web/Mywork/index.php?c=Picture&v=insert" name="myform">
		<table>
		<tr><td>请填写用户名：</td><td><input type="text" name="username"></td></tr>
		<tr><td>简单介绍文件：</td><td><textarea  name="fileintro" rows=10 cols=80></textarea></td></tr>
		<tr><td>上传文件：</td><td><input type="file" name="myfile"></td></tr>
		<tr><td><input type="submit" value="上传"></td><td></td></tr></table>
	</form>
</div>
</body>
</html>
