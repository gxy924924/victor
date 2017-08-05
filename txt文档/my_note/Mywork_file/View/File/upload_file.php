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
tr{
	height:40px;
}
</style>
</head>
<body>
	<center>
		<div id="main">
			<form method="post" enctype="multipart/form-data" name="upload_file" action="<?php  echo U_PATH; ?>?c=File&v=file_insert" >
				<h3>上传文件</h3>
				<table>
					<tr>
						<td><input type="file" name="file"  id=""></td>
					</tr>
					<tr>
						<td>请输入文件备注：<input type="text" name="file_remark" id=""></td>
					</tr>
					<tr>
						<td><input type="submit" name="upload" value="提交" id=""></td>
					</tr>
				</table>
			</form>
		</div>
	</center>
</body>
</html>