<?php

//第一次使用成熟smarty

include_once "./libs/Smarty.class.php";

$smarty=new Smarty;

//本质：把addr、name设置为smarty对象属性的一部分
//表面：把addr、name传递给模板以便使用
//标记：标记'{'是可以换的$smarty->left_delimiter(right_delimiter)='想要的标记即可'
$smarty->setTemplateDir("./View/");//设置模板文件位置和生成的文件的位置
$smarty->setCompileDir("./View_c/");
$smarty->assign('addr','建材城西路');
$smarty->assign('name','中财大厦');

$smarty->display("01.html");

?>