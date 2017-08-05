<?php
define("Host","0911");
include_once "./libs/Smarty.class.php";

$smarty=new Smarty;

$smarty->setTemplateDir("./View/");//设置模板文件位置和生成的文件的位置
$smarty->setCompileDir("./View_c/");

$smarty->assign('name',$_GET['name']);


$smarty->display("02.html");

?>