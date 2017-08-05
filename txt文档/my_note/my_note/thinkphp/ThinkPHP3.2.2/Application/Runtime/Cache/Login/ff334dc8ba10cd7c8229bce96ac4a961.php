<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf-8">
	<title>base</title>
	<style>
		#div1{
			height:50px;
			background-color:#ccc;
		}
		#div2{
			height:70px;
			background-color:#ccc;
		}
		#exit{
			float:right;
		}
	</style>
</head>
<body>
	<div id="div1">
		<a href=<?php echo U('Index/index');?> >index</a>
		<a href=<?php echo U('Index/show');?> >show</a>
		<a href="<?php echo U('Login/logout');?>" id="exit">exit</a>
	</div>
	<hr>
	
	<hr>
	<h1>上传功能</h1>
		<form action="<?php echo U('Index/upload');?>" method="post" enctype="multipart/form-data">
			<input type="file" name="img"></br>
			<input type="submit" value="提交" id="">
		</form>
	
	

	</br></br>
	<div id="div2">
	
	</div>
</body>
</html>