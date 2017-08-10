<?php 
require_once "sqlHelper.class.php";
//获取文件信息，文件内容换行符要注意是否正确。 \r  \n  \r\n
function key_file($filename,$file=""){
	$file_info=file_get_contents($file.$filename);
	$arr=explode("\n",$file_info);
	return $arr;
	
}

//获取文件目录中的关键字并将其存入数据库
function put_key_file($filename,$file=""){
	
	$sql=new sqlHelper();
	//获取文件信息
	
	$sql->settable('keyword_newkey_table');
	
	$arr_file=key_file($filename);//工具
	$count=0;
	foreach ($arr_file as $v) {
		$info=$sql->where('keyword="'.$v.'"')->select();
		if(count($info)){
		}else{
			$sql->add(['keyword'=>$v]);
			$count++;
		}
	}
	$res=$count."条文件信息导入";
	echo $res;
}

function show_sql_info(){
	$sql=new sqlHelper();
	//获取文件信息
	
	$sql->settable('keyword_newkey_table');
	$info=$sql->limit(0,20)->select();
	return $info;
}

//------------------------------------将文件信息存入数据库-------------------------------------------------
$filename="1.txt";
put_key_file($filename);
//-----------------------------------查看数据库---------------------------------------
// $info=show_sql_info();


// echo "<pre>";
// var_dump($info);
// echo "</pre>";

?>