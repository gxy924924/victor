<?php
define("Host","0911");
include_once "./libs/Smarty.class.php";
//创建smarty
$smarty=new Smarty;
//设置模板文件
$smarty->setTemplateDir("./View/");//设置模板文件位置和生成的文件的位置
$smarty->setCompileDir("./View_c/");

//开启缓存
$smarty -> caching=1;
//修改缓存文件的有效时间
$smarty->cache_lifetime=20;

$smarty->assign("mytime",date("Y-m-d H-i-s"),true);
/*
display方法执行
①判断是否开启缓存
②判断模板文件是否更新（如果跟新，3，4省略）
③判断缓存文件是否存在（缓存文件时间是否过期）
④判断混编文件是否存在
⑤展示模板内容
⑥开启缓存，进而生成缓存文件
*/


$smarty->display("21.html",$_GET['page']);

?>