<html>
<head>
<title>我的计算器</title>
<meta http-equiv="content-type" content="text/html";charset="utf-8"/>
</head>
<body>
<form action="result.php"method="post">
<table>
<tr><td>第一个数</td><td><input type="text" name="num1"></td></tr>
<tr><td>第二个数</td><td><input type="text" name="num2"></td></tr>
<tr>
<td>计算（输入+-*/）</td>
<td><select name="oper">
<option value="+">+</option>
<option value="-">-</option>
<option value="*">*</option>
<option value="/">/</option>
</select>
</td></tr>
<tr>
<td colspan="2"><input type="submit" value="计算结果"></td>
</tr>
</table>
</body>
</html>
