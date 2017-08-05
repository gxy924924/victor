<?php

//文件的创建和删除
//$path="d:/asd/aaa";
//1.创建文件和文件夹
function fileNew1(){
	if(!is_dir("/xx") && mkdir("/xx")){
		echo "成功创建文件夹。。。";
	}else{
		echo "失败";
	}
}
//2 递归创建 mkdir中0777，true必须有才能递归创建
function fileNew2($path){
	if(!is_dir($path)){
		if(mkdir($path,0777,true)){
			echo "成功创建文件夹。。。";
		}else{
			echo "创建失败";
		}
	}else{
		echo "文件已存在";
	}
}

//删除文件，不能删除有东西的文件，只能删除空文件
function fileDel($path){
	if(is_dir($path)){
		if(rmdir($path)){
			echo "成功s删除文件夹。。。";
		}else{
			echo "删除失败";
		}
	}else{
		echo "文件不存在";
	}
}
//创建文件并写入hello
$path="asd.txt";
function New1($path){
	$fp=fopen($path,"w+");
	fwrite($fp,"hello");
	echo "success";
	fclose($fp);
}

//删除文件
function Del1($path){
	if(is_file($path)){
		if(unlink($path)){
			echo "删除success";
		}else{
			echo "删除失败";
		}
	}else{
		echo "文件不存在";
	}
}
//fileNew2($path);
//fileDel($path);
//New1($path);
//Del1($path);
?>