<?php
header("content-Type:text/html;charset=utf-8");
header("Cache-Control:no-cache");
require_once 'MessageService.class.php';
//控制器
//接收信息
$sender=$_POST['sender'];
$getter=$_POST['getter'];
$con=$_POST['con'];

//把信息输出到文件里去
//file_put_contents("mylog.txt",$sender."||".$getter."||".$con."\r\n",FILE_APPEND);
$messageService=new MessageService();

$res=$messageService->addMessage($sender,$getter,$con);

//file_put_contents("mylog.txt",'$res='.$res."\r\n",FILE_APPEND);

if($res==1){}else{echo 'lost='.$res;}

?>