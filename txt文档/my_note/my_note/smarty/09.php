<?php
define("Host","0911");
include_once "./libs/Smarty.class.php";
//创建smarty
$smarty=new Smarty;
//设置模板文件
$smarty->setTemplateDir("./View/");//设置模板文件位置和生成的文件的位置
$smarty->setCompileDir("./View_c/");

$smarty->assign("week",3);

$smarty->display("09.html");

?>