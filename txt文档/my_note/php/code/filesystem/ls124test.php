<?php


//�ı�Ŀ¼--��һĿ¼
//chdir('../');
//�ı�Ŀ¼--��filesystem/xxĿ¼
//chdir('filesystem/xx');

//ȡ�õ�ǰ����Ŀ¼--D:\web\www\filesystem(\��б��)
function try1(){
$file=getcwd();
echo $file."</br>";
$handle=opendir($file);
 while ($files = readdir($handle)) {
        echo $files."</br>";
    }
closedir($handle);
}

//��б��(/)
//$file="D:/web/www/filesystem";
//��б���滻
function replace(){
	$search=" \ ";
	//�滻������ǰ�����ַ�����
	$search=str_replace(" ","",$search);
	$file=str_replace($search,"/",$file);
}

//��ʾ���ļ�
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
//strpos($val,".")��ʾ�ַ����ַ����״γ��ֵ�λ��
foreach(scandir($file) as $key=>$val){
	echo $key."=>".$val."=>";
	//filetype �� ȡ���ļ�����
	echo filetype($val);
	if(filetype($val)=="dir"){
		if(!empty($_GET['dir'])){
			$mydir=$_GET['dir']."/".$val."/";
			echo "<a href='?dir={$mydir}'>ת��</a>";
		}else{
			$mydir=$val."/";
			echo "<a href='?dir={$mydir}'>ת��</a>";
		}
	}else if(filetype($val)=="file"){
		if(!empty($_GET['dir'])){
			$mydir=$_GET['dir']."/".$val;
			echo "<a href='?dir={$mydir}&flag=down'>����</a>";
		}else{
			$mydir=$val;
			echo "<a href='?dir={$mydir}&flag=down'>����</a>";
		}
		
	}
	echo "</br>";
}

?>