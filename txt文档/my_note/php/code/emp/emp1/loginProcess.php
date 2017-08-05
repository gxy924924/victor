<?php
require_once 'adminService.class.php';
$adminService=new adminService();
require_once 'admin.class.php';
$admin=new admin();
//接收用户的数据
//获取验证码并验证
$checkCode=$_POST['checkCode'];
$adminService->tryCheckCode($checkCode);
//1.id
$admin->setId($_POST['id']);
//2.密码 
$admin->setPassword($_POST['password']);
//保存账号

if (empty($_POST['keep'])){
    setCookie("id",$admin->getId(),time()-100);
}else {
    setCookie("id",$admin->getId(),time()+7*2*24*3600);
}

//使用adminService.class.php

$adminService->checkAdmin($admin);





?>