<?php
	//这两句话很重要，第一句告诉浏览器返回的数据是xml格式
	//header("Content-Type:text/xml;charset=utf-8");//xml使用
	header("Content-Type:text/html;charset=utf-8");//json数据用
	//告诉浏览器不要缓存数据
	header("Cache-Control:no-cache");
	//接收数据(要和请求方式对应 post/get)
	//username以ajax中的参数url为准
	$getusername=$_POST['username'];
	//echo "用户名是".$getusername;//3号线
	/*-----------------------------xml格式--------------------------------
	//看看我们如何处理格式是xml的
	$info="";
	if($getusername=="aaa"){
		$info.="<res><mes>用户名不可用</mes></res>";//注意这里数据是返回给请求的页面
		
	}else{
		$info.="<res><mes>用户名可用,ok</mes></res>";
	}
	echo $info;
-----------------------------xml格式--------------------------------*/
		//json格式
		$info="";
	if($getusername=="aaa"){
		//这里$info是一个json数据格式的字串
		$info.='{"res":"用户名不可用"}';//注意这里数据是返回给请求的页面
		
	}else{
		$info.='{"res":"用户名可用..."}';
	}
	echo $info;
?>