<html>
<head>
<meta charset="utf-8">
<title>项目管理系统</title>
<script src="./Public/jquery-1.4.2/jquery.js"></script>
<style>
#main{
	width:1000px;
	height:auto;
}
#topFrame{
	width:1000px;
	height:60px;
}
#leftFrame{
	width:218px;
	margin:0;
}
#rightFrame{
	width:772px;
	margin:0;
}
#leftFrame,#rightFrame{
	height:650px;
	float:left;
}
#bottom{
	width:1000px;
	height:100px;
	border:1px solid #ccc;
	background-color:;
	padding-top:10px;
	float:left;
}
</style>
</head>
<body>
<center>
<div id="main">

	<iframe src="<?php  echo U_PATH ?>?c=Index&v=top" name="topFrame" scrolling="No" id="topFrame" title="topFrame"></iframe>
	<iframe src="<?php  echo U_PATH ?>?c=Index&v=left" name="leftFrame" scrolling="No" id="leftFrame" title="leftFrame"></iframe>
	<iframe src="<?php  echo U_PATH ?>?c=Index&v=right" name="mainFrame" scrolling="No" id="rightFrame" title="mainFrame"></iframe>
	<div id="bottom">
		制作人：vic	</br>
		制作时间：2017/2/17开始	</br>
	</div>
</div>
</center>
</body>
</html>