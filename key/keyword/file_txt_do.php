<?php 
set_time_limit (0); //不限时 24 * 60 * 60
require_once "sqlHelper.class.php";
//获取文件信息，文件内容换行符要注意是否正确。 \r  \n  \r\n
function key_file($filename,$file=""){
	$file_info=file_get_contents($file.$filename);
	$arr=explode("\n",$file_info);
	return $arr;
	
}

//关键字筛查
function check_file_key($filename,$file=""){
	$arr_file=key_file($filename);//工具
	$arr_yes_keyword=['pool','boat','water','float','raft','water','kayak'];
	$arr_not_keyword=['twister','bouncing','house','world','christmas','baton','car','obstacle','cooler','pump','trophies','fiberglass','vine','movie','fire department','screen','party','tube ','frozen','duel','kingdom','camping'];
	$arr_not_strict=['dies','electric','military','theatre','motor','mercury'];
	foreach ($arr_file as $key => $val) {
		$flag1=-1;
		$flag2=-1;
		$flag3=-1;
		foreach ($arr_not_keyword as $k => $v) {
			$posi1=stripos ($val,$v);
			if ($posi1>-1) {
				$flag1=1;
				$wd=$v;
			}
		}
		foreach ($arr_yes_keyword as $k1 => $v1) {
			$posi2=stripos ($val,$v1);
			if ($posi2>-1){
				$flag2=1;
			}
		}
		foreach ($arr_not_strict as $k2 => $v2) {
			$posi3=stripos ($val,$v2);
			if ($posi3>-1){
				$flag3=1;
				$wd=$v2;
			}
		}
		if($flag3==1){
			$not_ok_arr[]= $val."->".$key."->".$wd."->".$flag1.$flag2."</br>";
			unset($arr_file[$key]);
		}else if($flag1==1&&$flag2!=1){
			$not_ok_arr[]= $val."->".$key."->".$wd."->".$flag1.$flag2."</br>";
			unset($arr_file[$key]);
		}
	}
	//显示结果
	// echo "<pre>";
	// var_dump($not_ok_arr);
	// var_dump($arr_file);
	// echo "</pre>";
	$res1=put_keys_in_file($arr_file,'my_ok1.txt');
	$res2=put_keys_in_file($not_ok_arr,'my_nok1.txt');
	echo "<pre>";
	var_dump($res1);
	var_dump($res2);
	echo "</pre>";
	
}

//将关键字存入文件
function put_keys_in_file($arr,$file){
	foreach ($arr as $k => $v) {
		$arr[$k]=trim($v);
	}
	$str=implode("\n", $arr);
	$str=str_replace("\r", "", $str);
	$res=file_put_contents($file, $str);
	return $res;
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
$filename="kok2.txt";
check_file_key($filename);
//-----------------------------------查看数据库---------------------------------------
// $info=show_sql_info();
// $str="water slide rentals denver co";
// $posi2=stripos ($str,'water');

// echo "<pre>";
// var_dump($posi2);
// echo "</pre>";

?>