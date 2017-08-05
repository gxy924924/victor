<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta charset="utf-8">
<title>项目管理系统</title>
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
	width:220px;
}
#rightFrame{
	width:780px;
}
#leftFrame,#rightFrame{
	height:650px;
}
#bottom{
	width:1000px;
	height:100px;
	border:1px solid #ccc;
	background-color:;
	padding-top:10px;
}
</style>
</head>
<body>
<center>
<div id="main">
		<iframe src="top.html" name="topFrame" scrolling="No" id="topFrame" title="topFrame"></iframe>
			<iframe src="left.html" name="leftFrame" scrolling="No" id="leftFrame" title="leftFrame"></iframe>
			<iframe src="right.html" name="mainFrame" scrolling="No" id="rightFrame" title="mainFrame"></iframe>
			<div id="bottom">
			制作人：vic	</br>
			制作时间：2017/2/17开始	</br>
			</div>
</div>
</center>
</body>
</html>