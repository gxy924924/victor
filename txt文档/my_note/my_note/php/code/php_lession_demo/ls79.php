<!--php异常处理/错误处理-->
<?php
//$fp=fopen("aaa.txt","r");
//echo "ok";
//1判断文件是否存在
//2绝对路径，相对路径
if(!file_exists("aaa.txt")){
	echo "文件不存在"；
	exit();
}else{
	$fp=fopen("aaa.txt","r");
	echo "文件打开成功";
//....关闭
	fclose($fp)
	}

?>

