<html>
<head>
<meta charset="utf-8">
<title></title>
<style>
table{
	width:720px;
	border:1px solid #ccc;
}
img{
	width:220px;
	height:220px;
}
td{
	border:1px solid #ccc;
	width:225px;
	text-align:left;
}
#a_link{
	text-align:right;
}
</style>
</head>
<body>
<center>
	<table>
		<tr>
			<td></td><td></td><td></td>
		</tr>
	<?php foreach($this->rows as $key=>$row): ?>
		<?php if($key%3==0): $show_tr=1; ?>
			<tr>
		<?php endif; ?>

			<td>
				<div id="">
					<img src="<?=$row["move_to_file"]?>"></img>
				</div>
				<div id="">
					<font >商品种类：<?=$row['shop_type']?></font></br>
					<font >商品名称：<?=$row['item_name']?></font>
					<div id="a_link">
					<a href="<?=U_PATH?>?c=Picture&v=delete&file=<?=$row["move_to_file"]?>">删除</a>
					</div>
					
				</div>
			</td>

		<?php if($key%3==2):	$show_tr=0; ?>
			</tr>
		<?php endif; ?>
	<?php endforeach; ?>
		<?php if($show_tr==1): ?>
			</tr>
		<?php endif; ?>
	</table>
</center>


</body>
</html>