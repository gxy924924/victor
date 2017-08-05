<html>
<head>
<meta charset="utf-8">
<title></title>
<style>
body{
	border:1px solid #ccc;
}
table{
	border:1px solid #ccc;
	width:740px;
}
th,td{
	border:1px solid #ccc;
	height: 40px;
}
</style>
</head>
<body>
	<table>
		<tr>
			<th>序号</th>
			<th>文件名</th>
			<th>文件类型</th>
			<th>文件备注</th>
			<th>文件大小</th>
			<th>储存时间</th>
			<th>下载</th>
		</tr>
		<?php foreach($this->rows as $key=>$row): ?>
		<tr>
			<td><?=$row['id']; ?></td>
			<td><?=$row['file_true_name']; ?></td>
			<td><?=$row['type']; ?></td>
			<td><?=$row['file_remark']; ?></td>
			<td><?=$row['size']; ?></td>
			<td><?=$row['save_time']; ?></td>
			<td><a href="<?=U_PATH?>?c=File&v=download&file=<?=$row["move_to_file"]?>&filename=<?=$row["file_true_name"]?>">下载</a></td>
		</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>