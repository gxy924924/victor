<?php 
// header("Content-Type: application/vnd.ms-excel; charset=UTF-8"); 
//将文件中的csv全部合并（实际上dos的批处理命令更好用 copy *.csv book.csv）

function file_get_csv($file){
	$fp=fopen($file,'r');
	while($data=fgetcsv($fp)){
		$file_inner[]=$data;
	}
	foreach ($file_inner as $key => $value) {
		$file_inner[$key]=$value[0];
	}
	return $file_inner;
}

$dir="./keyword-all/";
$info=scandir($dir);
$file_info_all="";
foreach ($info as $key => $val) {
	if($val=='.'||$val=='..'){
		// echo $val;
	}else{
		$file=$file=$dir.$val;
		$file_info_all.=file_get_contents($file);
	}
}
$file_input=$dir.'all.txt';
$res=file_put_contents($file_input, $file_info_all);
// $file=$dir.$info[2];
// $file_name=$info[2];
// $file_info=file_get_contents($file);
// $key_info=mb_detect_encoding($file_info[1]);
// preg_match_all("/.*[\n].*[\n]Keyword Ideas.(.*)?.usd.*/i", $file_info, $arr);
// preg_match_all("/.*[\n]/i", $file_info, $arr);
// preg_match("/.*?s../ui",$file_info[2],$key_info);


echo "<pre>";
// var_dump($info);
// var_dump($file_info_all);
var_dump($res);
// var_dump($arr);
// var_dump($file_info);
echo "</pre>";

?>