<?php 
header("Content-type: text/html; charset=utf-8"); 
set_time_limit (0); //不限时 24 * 60 * 60

function show_index_page($require_file){
	//需要$image_count  $_GET['keyword'] $image_url
	require_once $require_file;
}


require_once "sqlHelper.class.php";
$sql=new sqlHelper();

$_GET['keyword']="adidas shoes";
// $res=$sql->settable('keyword_newkey')->add($add_arr);


// --将文件信息存入txt文件工具----------------------------------
// $string_input=implode("\r\n",$arr2);
// $res=file_put_contents("./url/adidas nmd.txt", $string_input);

//图片页（id）信息
	
	//图片页数量
	$_POST['page']=empty($_POST['page'])?0:$_POST['page']-1;
	$p_num=15;
	$start_num=$_POST['page']*$p_num;
	
	$image_count=$sql->set_query('select count(id) from keyword_newurl limit 1')->select();
	$image_count=$image_count[0]['count(id)'];

	$image_url=$sql->set_query('select * from keyword_newurl limit '.$start_num.','.$p_num)->select();
	$page_total=ceil($image_count/$p_num);




echo "<pre>";
// var_dump($image_url);
var_dump($sql->getlastsql());
// // var_dump($arr2);
echo "</pre>";

require_once 'show_image.html';

?>