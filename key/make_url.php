<?php 
header("Content-type: text/html; charset=utf-8"); 
set_time_limit (0); //不限时 24 * 60 * 60

$filename="./url/f.txt";
$info=file_get_contents($filename);
preg_match_all("/http.*?(.png|.jpg|.jpeg)/", $info, $arr);

foreach ($arr[0] as $key => $val) {
	if(strlen($val)>500){

	}else{
		$arr2[$key]=$val;
	}
	
}

require_once "sqlHelper.class.php";


$sql=new sqlHelper();

//数据库加载

$add_arr['keyword']="adidas shoes";
$res=$sql->settable('keyword_newkey')->add($add_arr);
$key_info=$sql_key_arr=$sql->settable('keyword_newkey')->where('keyword="'.$add_arr['keyword'].'"')->select();
$input_url["pid"]=$key_info[0]['id'];
foreach ($arr2 as $key => $val) {
	$input_url["url"]=$val;
	$res=$sql->settable('keyword_newurl')->add($input_url);
}


// // --将文件信息存入txt文件工具----------------------------------

// $string_input=implode("\r\n",$arr2);
// $res=file_put_contents("./url/adidas shoes.txt", $string_input);




// $info=json_encode($info);
// $info=json_decode($info);
echo "<pre>";
var_dump($res);
var_dump($sql->getlastsql());
// var_dump($arr2);
echo "</pre>";

?>