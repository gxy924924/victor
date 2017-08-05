<?php
//文件名//by.png /myerr.txt
#$file_name="by.png";
//如果文件名是中文 则需要转码为gb2312，否则会找不到
//如果不在此目录则需再写一个路径，并将下面进行修改
$file_name="联通宽带.png";
$file_name=iconv("utf-8","gb2312",$file_name);
//1打开文件
if(!file_exists($file_name)){
	echo "文件不存在";
	return;
}
$fp=fopen($file_name,"r");

//获取下载文件的大小
$file_size=filesize($file_name);

//返回的是文件的形式（stream流）
header("Content-type:application/octet-stream");
//按照字节大小返回
header("Accept-ranges:bytes");
//返回文件大小
header("Accept-Length:$file_size");
//这里客户端的弹出对话框，对应的文件名
header("Content-Disposition:attachement;filename=".$file_name);

//向客户端回送数据
$buffer=1024;
//为了下载的安全，最好做一个文件读取计数器
$file_count=0;
//这句话用于判断文件是否结束 
//说明：eof(end of file)//&&($file_size-$file_count>0)
while(!feof($fp)&&($file_size-$file_count>0)){
	$file_data=fread($fp,$buffer);
	//统计读了多少个字节
	$file_count+=$buffer;
	//把部分数据回送给浏览器
	echo $file_data;
}
//关闭文件
fclose($fp);

?>

