<?php
	//获取数据
	//$title="国家开会";
	//$content="北京机动车限行";
	//1.引入Smarty
	require_once "MiniSmarty.class.php";
	//2.实例化该smarty对象
	$smarty=new MiniSmarty;
	
	//把字符串信息设置为模板引擎类的属性信息
	$smarty->assign('title','国家开会');
	$smarty->assign('content','北京机动车限行');
	//3.调用compile方法，同时传递html模板文件参数
	//该方法里把html文件内部标记替换为php标记
	$smarty->compile("smarty.html");
	
?>