<?php
require_once 'MessageService.class.php';
header("content-Type:text/xml;charset=utf-8");
header("Cache-Control:no-cache");

//控制器(获取数据)
//接收信息
$sender=$_POST['sender'];
$getter=$_POST['getter'];

//把信息输出到文件里去
//file_put_contents("mylog.txt",$sender."||".$getter."\r\n",FILE_APPEND);
$messageService=new MessageService();

$mesList=$messageService->getMessage($sender,$getter);
//file_put_contents("mylog.txt",'$mesList='.$mesList."\r\n",FILE_APPEND);
echo $mesList;
?>