<html>
<head>
<meta charset="utf-8">
<title></title>
<script src="./Public/jquery-1.4.2/jquery.js"></script>
<style>
#main{
	width:450px;
	border:1px solid #ccc;
	margin-top:100px;
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
			<h4>登录</h4>
		</div>
		<div id="">
			<form action="<?php  echo U_PATH; ?>?c=Index&v=logincheck" method="post">
				<div id="">
				<center>
				<table >
					<tr>
						<td>用户名</td>
						<td><input type="text" name="username" id=""></td>
					</tr>
					<tr>
						<td>密　码</td>
						<td><input type="text" name="password" id=""></td>
					</tr>
					<tr>
						<td>验证码</td>
						<td><input type="text" name="checkcode" id=""></td>
					</tr>
					<tr>
						<td></td>
						<td><img id="check" src="<?php  echo U_PATH; ?>?c=User&v=checkcode" onclick="change();"></td>
					</tr>
					<tr>
						<td colspan=2>
							<div id="sub">
								<input type="submit" value="提交" id="bt">
							</div>
							<div id="sub">
								<input type="reset" value="重置" id="bt">
							</div>
						</td>
					</tr>
					<tr>
						<td colspan=2>
							<a href="<?php  echo U_PATH; ?>?c=Index&v=register">注册一个？</a>
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
	function change(){
		var date=new Date();
		$("#check").attr("src",$("#check").attr("src")+"&date="+date.getTime());//重新获取验证码
		//alert($("#check").attr("src"));
	}
	
</script>
</html>