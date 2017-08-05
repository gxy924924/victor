<?php
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set('Asia/Shanghai');
//1文件信息

//读取文件
$file_path="test.txt";
//该函数返回一个指向文件的指针

function read1($file_path){
if(file_exists($file_path)){
	//打开文件
	$fp=fopen($file_path,"a+");
	//读内容
	$con=fread($fp,filesize($file_path));
	//取出看看
	echo "文件的内容是：</br>";
	//在默认情况下，我们得到内容输出到网页后，不会换行因为网页
	//不认\r\n是换行符，将其替换为</br> 使用str_replace()
	echo "</br>源文件:</br>".$con;
	$con=str_replace("\r\n","<br/>",$con);
	echo "</br>修改换行符：</br>".$con;
	//关闭
	fclose($fp);
}else{
	echo "文件不存在";
}
}

//2
function read2($file_path){
	$con=file_get_contents($file_path);
	$con=str_replace("\r\n","<br/>",$con);
	echo "</br>第二种读取方法：</br>".$con;
}
//3
function read3($file_path){
	$fp=fopen($file_path,"r");
	$buffer=1024;
	echo "</br>第三种读取方法：</br>";
	while(!feof($fp)){
		$str=fread($fp,$buffer);
		$str=str_replace("\r\n","<br/>",$str);
		echo $str;
	}
	fclose($fp);
}
//read1($file_path);
//read2($file_path);
read3($file_path);
?>