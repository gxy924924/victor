<html>
<head>
<meta charset="utf-8">
<script src="./Public/jquery-1.4.2/jquery.js">
</script>
<title></title>
<style>
#main{
	border:1px solid #ccc;
}
table{
	width:750px;
	margin-left:3px;
}
table tr{
height:40px;
}
#h3{
	background-color:#F3F6F2;
	height:35px;
	margin:0px;
	text-align:center;
}
</style>
</head>
<body>
<div id="main">

	<h3 id="h3">查看用户</h3>
	<table>
		<tr>
			<td>id</td>
			<td>用户名</td>
			<td>注册时间</td>
			<td>是否管理员</td>
			<td>修改</td>
			<td>删除</td>
		</tr>
		<?php foreach($this->rows as $k => $val): ?>
			<?php if($k%2==0): ?>
				<tr style="background-color:#F3F6F2">
			<?php else: ?>
				<tr>
			<?php endif; ?>
				<td><?php echo $val["id"]; ?></td>
				<td><?php echo  $val["username"]; ?></td>
				<td><?php echo  $val["regtime"]; ?></td>
				<td><?php echo  $val["admin"]; ?></td>
				<td><a href="<?php  echo U_PATH; ?>?c=User&v=edit&id=<?php echo $val["id"]; ?>" onclick="return change(<?php echo $val["id"]; ?>)" >修改</a></td>
				<td><a href="<?php  echo U_PATH; ?>?c=User&v=delete&id=<?php echo $val["id"]; ?> " onclick="return del(<?php echo $val["id"]; ?>)">删除</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?=$this->show?>
	</div>
</body>
<script>
	function change(id){
		var mycon=confirm("你确定要修改id="+id+"吗");
		return mycon;
	}
	function del(id){
		var mycon=confirm("你确定要删除id="+id+"吗");
		return mycon;
	}
</script>
</html>