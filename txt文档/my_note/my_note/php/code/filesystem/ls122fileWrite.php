<?php

//写入文件

//1.传统方法

$filepath="test.txt";
function write1($filepath){
if(file_exists($filepath)){
	$fp=fopen($filepath,"a");
	fwrite($fp,"\r\nhello");
	echo "success";
}else{
	echo "文件不存在";
}
}

//2
function write2($filepath){
	file_put_contents($filepath,"\r\nhello222",FILE_APPEND);
	echo "success2";
}

write2($filepath);

?>