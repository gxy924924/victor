<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title></title>
</head>
<body>
<center>
<h1>小数据缓存F函数</h1>
	<table border=1px>
		<tr>
			<td>id</td>
			<td>username</td>
		</tr>
	<?php if(is_array($rows)): foreach($rows as $key=>$v): ?><tr>
			<td><?php echo ($v[id]); ?></td>
			<td><?php echo ($v[username]); ?></td>
		</tr><?php endforeach; endif; ?>
	</table>
	</center>
</body>
</html>