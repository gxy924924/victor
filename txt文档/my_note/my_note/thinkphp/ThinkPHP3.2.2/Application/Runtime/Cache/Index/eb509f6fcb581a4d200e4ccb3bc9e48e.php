<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title></title>
	<script src="/ThinkPHP3.2.2/Public/jquery-1.4.2/jquery.js"></script>
	<style>
		#main{
			width:400px;
			height:300px;
			margin:0 auto;
			background:#ccc;
		}
	</style>
</head>
<center>
	<body>
		<div id="main">
	
		</div>
		<button id="btn">单击</button><button id="btn2">单击2</button>
	</body>
</center>
<script>
$("#btn").click(function(){
	$.post('<?php echo U("Test/myaj_show","","");?>',function(data){
		//alert(data);
		$("#main").html(data);
	});
});
$("#btn2").click(function(){
	$.post('<?php echo U("Test/myaj_return","","");?>',function(rtn){
		//alert(data);
		$("#main").html(rtn.name+"</br>"+rtn.age);
	});
});
</script>
</html>