<?php
define("Host","0911");
include_once "./libs/Smarty.class.php";

$smarty=new Smarty;

$smarty->setTemplateDir("./View/");//设置模板文件位置和生成的文件的位置
$smarty->setCompileDir("./View_c/");

//模拟从数据库获取信息
$smarty->assign("hobby","year");

$smarty->display("04.html");

?>