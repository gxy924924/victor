<?php
header("Content-type:text/html;charset=utf-8");
require_once "ls87download.php";
if(!empty($_GET['dir'])){
	chdir($_GET['dir']."/");
	if(!empty($_GET['file'])){
		$filename=$_GET['file'];
		$filename=replace($filename);
		file1($filename);
		exit;
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
		if(empty($_GET['dir'])){
			$mydir=$val."/";
			echo "<a href='?dir={$mydir}'>转到</a>";
		}else{
			$mydir=$_GET['dir']."/".$val."/";
			echo "<a href='?dir={$mydir}'>转到</a>";
		}
	}else if(filetype($val)=="file"){
		if(empty($_GET['dir'])){
			$fileget=$file."/".$val;
			echo "<a href='?file={$fileget}'>下载</a>";
		}else{
			$mydir=$_GET['dir'];
			$fileget=$file."/".$val;
			echo "<a href='?dir={$mydir}&file={$fileget}'>下载</a>";
		}
		
	}
	echo "</br>";
}

?>