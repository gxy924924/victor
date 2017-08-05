<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf-8">
	<title>base</title>
	<style>
		#div1{
			height:50px;
			background-color:#ccc;
		}
		#div{
			height:70px;
			background-color:#ccc;
		}
	</style>
</head>
<body>
	<div id="div1">
		<a href=<?php echo U('Index/index');?> >index</a>
		<a href=<?php echo U('Index/show');?> >show</a>
	</div>
	<hr>
	
		<h3>用户<?php echo ($username); ?>登陆成功：</h3>
		<hr>
		<center>
		<h1>查看表test中的信息</h1>
		<table border=1px width=200px>
			<tr>
				<td>id</td>
				<td>name</td>
				<td>age</td>
			</tr>
			<?php if(is_array($rows)): foreach($rows as $k=>$row): ?><tr>
				<td><?php echo ($row[id]); ?></td>
				<td><?php echo ($row[name]); ?></td>
				<td><?php echo ($row[age]); ?></td>
			</tr><?php endforeach; endif; ?>
		</table>
		<?php echo ($show); ?>
		</center>

		<form action="" method="post" enctype="multipart/form-data">
			<input type="file" name="upload" id="">
		</form>
	
	<a href="<?php echo U('Login/logout');?>" >exit</a>
	<div id="div2">
	
	</div>
</body>
</html>