<?php
header('Content-type:text/html;charset=utf-8');
date_default_timezone_set('Asia/Shanghai');
//1文件信息

//打开文件
$file_path="test.txt";
//该函数返回一个指向文件的指针
if($fp=fopen($file_path,"r")){
	$file_info=fstat($fp);
	echo "<pre>";
	print_r($file_info);
	echo "</pre>";

	//取出看看
	echo "<br/>文件大小是 {$file_info['size']}";
	echo "<br/>文件上次修改时间:".date("Y-m-d H:i:s",$file_info['mtime']);
	echo "<br/>文件上访问时间:".date("Y-m-d H:i:s",$file_info['mtime']);
	echo "<br/>文件上次change时间:".date("Y-m-d H:i:s",$file_info['ctime']);

	//
	fclose($fp);
}else{
	echo "打开文件失败";
}
//第二种方式获取文件信息(不需要打开文件fopen)

echo "<br/>".filesize($file_path);
echo "<br/>".fileatime($file_path);
echo "<br/>".filectime($file_path);
echo "<br/>".filemtime($file_path);

?>