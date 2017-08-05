<html>
<head>
<meta charset="utf-8">
<title></title>
<style>
#main{
	width:450px;
	border:1px solid #ccc;
}
#top{
	background-color:#ccc;
	text-align:center;
}
table{
	width:300px;
	height:200px;
	text-align:center;
}
#sub{
	float:left;
	width:143px;
	border:0px solid red;
}
#bt{
	width:70px;
	height:30px;
	font-size:14;
}
</style>
</head>
<body>
	<center>
	<div id="main">
		<div id="top">
			<h4>修改用户</h4>
		</div>
		<div id="">
			<form action="<?php  echo U_PATH; ?>?c=User&v=update" method="post">
				<div id="">
				<center>
				<table >
					<tr>
						<td>id</td>
						<td><?=$this->rows[0]['id']?><input type="hidden" name="id" value="<?=$this->rows[0]['id']?>" id=""></td>
					</tr>
					<tr>
						<td>用户名</td>
						<td><input type="text" name="username" value="<?=$this->rows[0]['username']?>" id=""></td>
					</tr>
					<tr>
						<td>密　码</td>
						<td><input type="password" name="password" value="<?=$this->rows[0]['password']?>" id=""></td>
					</tr>
					<tr>
						<td>管理员</td>
						<td><input type="text" name="admin" value="<?=$this->rows[0]['admin']?>" id=""></td>
					</tr>
					<tr>
						<td colspan=2>
							<div id="sub">
								<input type="submit" value="修改" id="bt">
							</div>
							<div id="sub">
								<input type="button" value="取消" id="bt" onclick="myreturn();">
							</div>
						</td>
					</tr>
				</table>
				</center>
				</div>
			</form>
		</div>
	</div>
	</center>
</body>
<script>
	function myreturn(){
		var conf=confirm('不修改了么');
		if(conf){
			location="<?php  echo U_PATH; ?>?c=User&v=index";
		}
	}
</script>
</html>