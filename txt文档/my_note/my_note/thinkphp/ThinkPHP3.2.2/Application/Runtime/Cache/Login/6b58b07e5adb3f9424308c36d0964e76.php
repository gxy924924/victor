<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf-8">
	<title>login</title>
	<style>
		tr{
			height:40px;
		}
		#verify{
			float:right;
			border:1px solid red;
		}

	</style>
	<script src="/ThinkPHP3.2.2/Public/jquery-1.4.2/jquery.js"></script>
</head>
<body>
	<center>
	<h3>用户注册：</h3>
	<hr>
	<form action="<?php echo U('insert');?>" method="post">
		<table border=0px>
		<tr><td>用户名：</td><td><input type="text" name="username" id=""></td></tr>
		<tr><td>密　码：</td><td><input type="text" name="password" id=""></td></tr>
		<tr><td>确认密码：</td><td><input type="text" name="repassword" id=""></td></tr>
		<tr><td>验证码：</td><td><input type="text" name="fcode" id=""></td></tr>
		<tr ><td></td><td ><span id="verify"><img  id="img1" src="<?php echo U('verify');?>"/></spans></td></tr>
		<tr><td><input type="submit" value="提交"></td></tr>
		</table>
	</form>
	</center>
</body>
<script>
	
	$("#img1").click(function(){
		var timenow = new Date().getTime();
		//alert("<?php echo U('verify','',"");?>/"+timenow);
		$(this).attr({'src':"<?php echo U('verify','',"");?>/"+timenow})
	});
</script>
</html>