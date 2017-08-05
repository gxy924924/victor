<html>
<head>
<title>查询字典</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
</head>
<body>
<table border=1px>
<tr><td>
<h1>查询单词</h1>
<form action="wordProcess.php" method="post">
请输入英文单词：<input type="text" name="enword"/>
<input type="hidden" name="type" value="search">
<input type="submit" value="查询中文">
</form>
</td></tr>
<tr><td>
<h1>添加单词</h1>
<form action="wordProcess.php" method="post">
请输入英文：<input type="text" name="enword"/></br>
请输入中文：<input type="text" name="chword"/>
<input type="hidden" name="type" value="add">
<input type="submit" value="添加单词">
</form>
</td></tr>
</table>
</body>
</html>