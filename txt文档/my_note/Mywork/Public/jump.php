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
</style>
</head>
<body>
	<center>
	<div id="main">
		<h1>结果：<?=$this->res?></h1>
		<h1><font color="">倒计时：</font><font id="time" color="red"></font></h1>
		<h4><a href="<?=$this->url?>"><?=$this->url?></a></h4>
	</div>
	</center>
</body>
<script>
	var second=5;
	function timeshow(){
		if(second==0){
			//alert("timeout");
			location.assign("<?=$this->url?>");
		}
		$("#time").text(second);
		second--;
	}
	window.setInterval("timeshow()",1000);
</script>
</html>