<?php
define("Host","0911");
include_once "./libs/Smarty.class.php";
//创建smarty
$smarty=new Smarty;
//设置模板文件
$smarty->setTemplateDir("./View/");//设置模板文件位置和生成的文件的位置
$smarty->setCompileDir("./View_c/");

//$config['date'] = '%I:%M %p';

$smarty->assign('baidu','<a>baidu</a>');
$smarty->assign('title',"shanghai\ntianjin\nguangzhou");
$smarty->assign('talk','good afternoon everyone');


$smarty->display("16.html");

?>