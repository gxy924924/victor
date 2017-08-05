<?php


//改变目录--上一目录
//chdir('../');
//改变目录--到filesystem/xx目录
//chdir('filesystem/xx');

//取得当前工作目录--D:\web\www\filesystem(\右斜杠)
function try1(){
$file=getcwd();
echo $file."</br>";
$handle=opendir($file);
 while ($files = readdir($handle)) {
        echo $files."</br>";
    }
closedir($handle);
}

//左斜杠(/)
//$file="D:/web/www/filesystem";
//将斜杠替换
function replace(){
	$search=" \ ";
	//替换函数（前，后，字符串）
	$search=str_replace(" ","",$search);
	$file=str_replace($search,"/",$file);
}

//显示子文件
function filescan($file){
	$files1=scandir($file);
//	echo "<pre>";
//	print_r($files1);
//	echo "</pre>";

	foreach($files1 as $key=>$val){
		echo $key."=>".$val."</br>";
	}
}

if(!empty($_GET['dir'])){
	if(!empty($_GET['flag'])){
		echo getcwd().$_GET['dir'];
		echo "</br>";
	}else{
		chdir($_GET['dir']."/");
	}
}
$file=getcwd();
echo  $file."</br>";
scandir($file);
//strpos($val,".")显示字符在字符串首次出现的位置
foreach(scandir($file) as $key=>$val){
	echo $key."=>".$val."=>";
	//filetype — 取得文件类型
	echo filetype($val);
	if(filetype($val)=="dir"){
		if(!empty($_GET['dir'])){
			$mydir=$_GET['dir']."/".$val."/";
			echo "<a href='?dir={$mydir}'>转到</a>";
		}else{
			$mydir=$val."/";
			echo "<a href='?dir={$mydir}'>转到</a>";
		}
	}else if(filetype($val)=="file"){
		if(!empty($_GET['dir'])){
			$mydir=$_GET['dir']."/".$val;
			echo "<a href='?dir={$mydir}&flag=down'>下载</a>";
		}else{
			$mydir=$val;
			echo "<a href='?dir={$mydir}&flag=down'>下载</a>";
		}
		
	}
	echo "</br>";
}

?>