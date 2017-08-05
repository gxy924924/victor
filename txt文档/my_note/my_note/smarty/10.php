<?php
define("Host","0911");
include_once "./libs/Smarty.class.php";
//创建smarty
$smarty=new Smarty;
//设置模板文件
$smarty->setTemplateDir("./View/");//设置模板文件位置和生成的文件的位置
$smarty->setCompileDir("./View_c/");

//$smarty->assign('seled','c');//单选
$smarty->assign('seled',array("a","c","d"));//多选
$smarty->assign("outval",array("a"=>"篮球","b"=>"排球","c"=>"棒球","d"=>"看书"));
$smarty->assign("output",array('篮球','排球','棒球','看书'));
$smarty->assign("val",array('a','b','c','d'));

//城市下拉列表
$smarty->assign('area',array(1=>'沈阳',2=>'大连',3=>'铁岭',4=>'开源'));//多选
//选中
$smarty->assign('seled',array(2,3,4));//多选


$smarty->display("10.html");

?>