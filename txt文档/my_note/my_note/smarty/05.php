<?php
define("Host","0911");
include_once "./libs/Smarty.class.php";

$smarty=new Smarty;

$smarty->setTemplateDir("./View/");//设置模板文件位置和生成的文件的位置
$smarty->setCompileDir("./View_c/");

//索引数组
$smarty->assign("fruit",array('apple','banana','applepine','shizi','orange'));
//关联数组
$smarty->assign('animal',array('huaGS'=>'monkey','deguo'=>'dog','northeast'=>'bear'));
//多维
$smarty->assign('test',array(array('0-0','0-1'),array('1-0','1-1'),array()));

$smarty->display("05.html");

?>