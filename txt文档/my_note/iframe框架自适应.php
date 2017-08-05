<html>
<head>
<meta charset="utf-8">
<title>项目管理系统</title>
<script src="./Public/jquery-1.4.2/jquery.js"></script>
<style>
	iframe{
		width: 100%;
	}
</style>
</head>
<body>
<center>
<div id="main">

	<iframe src="<?php  echo U_PATH ?>?c=Index&v=header" name="headerFrame" scrolling="No" id="headerFrame" title="headerFrame"></iframe>
	<iframe src="<?php  echo U_PATH ?>?c=Index&v=body" name="bodyFrame" scrolling="No" id="bodyFrame" title="bodyFrame"></iframe>
	<iframe src="<?php  echo U_PATH ?>?c=Index&v=bottom" name="bottomFrame" scrolling="No" id="bottomFrame" title="bottomFrame"></iframe>
	<div id="bottom">
		制作人：vic	</br>
		制作时间：2017/3/29开始	</br>
		<button onclick="c1();">headerFrame</button>
	</div>
</div>
</center>
</body>
<script>
	var iframes=["headerFrame","bodyFrame","bottomFrame"];
	function setIframeHeight(iframe) {
		if (iframe) {
			var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
			if (iframeWin.document.body) {
				iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
				// alert(iframe.height);
			}
		}
	};
	window.onload=function(){ 
		for (var i = 0;i<iframes.length;i++) {
			var ifm= document.getElementById(iframes[i]); 
			setIframeHeight(ifm);
		};

	} ;
</script>
</html>
