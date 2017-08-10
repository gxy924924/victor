<?php 
header("Content-type: text/html; charset=utf-8"); 
require_once "sqlHelper.class.php";
set_time_limit(0);
//取出分类刷好的图片——————————————————————————————————————————————————————
$require_file="show_index2.html";

	$sql=new sqlHelper();


	echo "<pre>";
	$keyword_info=$sql->settable('keyword')->select();
	if(!empty($_GET['keyword'])){
		//获取相应的关键字（pid）
		$keyword_key=explode('+',$_GET['keyword']);
		$sql_key_like=implode('% and like %', $keyword_key);
		$keyword_info2=$sql->set_query('select * from keyword where `keyword` like "%'.$sql_key_like.'%"')->select();
		foreach ($keyword_info2 as $key => $val) {
			$keyword_id_arr[$key]=$val['id'];
		}
		$keyword_id_str=implode(',',$keyword_id_arr);
		//图片页（id）信息
		$image_info=$sql->set_query('select * from keyword_page where `keyword_id` in ('.$keyword_id_str.')')->select();
		//图片页数量
		$image_count=$sql->set_query('select count(id) from keyword_page where `keyword_id` in ('.$keyword_id_str.') limit 1')->select();
		$image_count=$image_count[0]['count(id)'];
		$page=empty($_POST['page'])?0:$_POST['page']-1;
		//获取img
		$image_id_str=empty($image_info[$page]['images_id'])?0:$image_info[$page]['images_id'];
		$image_url=$sql->set_query('select * from keyword_url where `id` in ('.$image_id_str.')')->select();
		// $image_url=$sql->set_query('select keyword_url.*,keyword.keyword from keyword_url left join keyword on keyword_url.pid=keyword.id where keyword_url.id in ('.$image_id_str.')')->select();

		// var_dump($image_url);
		// var_dump($image_count);
		// var_dump($sql->getlastsql());
	}

	
	
	// if(empty($_GET))
	// $image_info=$sql->settable('keyword_page')->where(' ')->find();


	
	// var_dump($page_url);
	// var_dump($sql->getlastsql());
	// var_dump($keyword_url_info);
	echo "</pre>";
	


require_once $require_file;

?>