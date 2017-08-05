<html>
<head>
<?php require_once APP."Index/View/Index/title.php"; ?>
	<title>跳转页面</title>
<style>
#main{
	/*width:450px;*/
/*	border:1px solid #ccc;*/
	margin-top:100px;
}
</style>
</head>
<body>
	<div class="container text-center">
		<center>
			<div id="main" class="well">
				<h3>结果：<?=$this->res?></h3>
				<h3><font color="">倒计时：</font><font id="time" color="red"></font></h3>
				<h4>手动跳转：<a href="<?=$this->url?>"><?=$this->url?></a></h4>
			</div>
		</center>
			
	</div>
	
</body>
<script>
	var second=<?=$this->time?>;
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