<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script src="./jquery.min.js">	</script>
	<title>key</title>
	<style>
		.show_info{
			border: 1px solid #ccc;
			width: 600px;
			height:400px;
			overflow-x: auto;  
		}
	</style>
</head>
<body>
	<div class="show_info">
	显示信息</br>
	</div>

	</br></br>

	<button id="file_info" onclick="">获取文件信息</button>

	</br></br>
	<input type="text" id="num" value="0"> 每个文件url数量限制(0为不受限)<br/>
	<button id="url_info">获取url文件信息</button>
	
	</br></br>
	<input type="text" id="num2" value='5'> 每次校验的url条数<br/>
	<input type="text" id="parrallel" value='5'> 并行校验数<br/>
	<!-- <button id="" onclick="timer=setInterval(check_interval,2000);">开始校验url</button> -->
	<button id="" onclick="for_fun();">开始校验url</button>
	<?php define('BS_URL',"http://".$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],"/"))."/"); ?>
	<input type="hidden" id="base_url" value="<?=BS_URL?>">
</body>
<script>
	$('#file_info').click(function(){
		var base_url=$('#base_url').val();
		var url=base_url+"key.php?key=get_key_file";
		// alert(url);
		$.post(url,function(data){
			data=data+"</br>";
			$(".show_info").append(data);
		});

	});
	$('#url_info').click(function(){
		var num=$("#num").val();
		var base_url=$('#base_url').val();
		var url=base_url+"key.php?key=get_key_url&num="+num;
		$.post(url,function(data){
			data=data+"</br>";
			$(".show_info").append(data);
		});
		alert("已开始获取数据，请不要再次点击");


	});

		var run_num=0;
		var check_num=0;

	function for_fun(){
		var num2=$("#num2").val();
		var base_url=$('#base_url').val();
		var url=base_url+"key.php?key=get_url_generate&num="+num2;
		var parrallel=$("#parrallel").val();
		for (var i =0; i < parrallel; i++) {
			start=i*num2;
			check_url(url,start);
			$(".show_info").append("从"+start+"开始计算"+num2+"条</br>");
		}
	}

	function check_url(url,start){
		url=url+"&start_num="+start;
		// $(".show_info").append(url);
		$.post(url,function(data){
			data=data+"</br>";
			$(".show_info").append(data);
			if(data=='finish'){
				// check_num=check_num;
			}else{
				// check_num=check_num+1;
				// return 
			}
		});
	}
</script>
</html>