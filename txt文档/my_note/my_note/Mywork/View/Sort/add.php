<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<title></title>
<style>
#main{
	border:1px solid #ccc;
	width:600px;
}
table{
	border:1px solid #ccc;
	width:500px;
}
td{
	height:50px;
	border:1px solid #ccc;
}
#table2{
	margin-top:20px;
}
</style>
</head>
<body>
	<center>
		<div id="main">
			<form method="post" action="<?=U_PATH?>?c=Sort&v=insert" >
				<h3>添加分类</h3>
				<table>
					<tr>
						<td>
							请输入商品分类：<input type="text" name="child_key" id="">
							<input type="hidden" name="parent_key" value="top" id="">
						</td>
					</tr>
					<tr>
						<td><input type="submit" value="提交" id=""></td>
					</tr>
				</table>
			</form>

			<form action="<?=U_PATH?>?c=Sort&v=insert" method="post">
				<table id="table2">
					<tr>
						<td>请选择商品分类：
							<select name="parent_key">
							<?php foreach($this->rows as $key=>$val): ?>
							<option value="<?=$val["child_key"]?>"><?=$val["child_key"]?></option>
							<?php endforeach; ?>
							</select>
						</td>
					
					</tr>
					<tr>
						<td>
							请输入商品类型：<input type="text" name="child_key" id="">
						</td>
					</tr>
					<tr>
						<td><input type="submit" value="提交" id=""></td>
					</tr>
				</table>
			</form>
			<div>说明：1.请依次先添加商品分类，在添加商品类型，每次添加只能添加一条</br>
			2.商品分类是大的分类（如：电器），商品类型是具体的分类（如：电饭锅）</div>
		</div>
	</center>
</body>
</html>