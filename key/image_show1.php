<?php 
header("Content-type: text/html; charset=utf-8"); 

set_time_limit(0);


function curl_test($url,$pr_ip=0,$pr_port=0){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); //不进行ssl认证


	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 	//返回信息不直接输出
	$result = curl_exec($ch);
	// var_dump(curl_error($ch));
	curl_close($ch);
	return $result;
	
}

	$require_file="show_index.html";

	
	if(empty($_POST['language'])||empty($_POST['keyword'])){
		$before_info= "未输入需求，或需求输入不足";
		require_once $require_file;
		exit;
	}

	$hl=$_POST['language'];
	$keyword=$_POST['keyword'];
	$start_limit=empty($_POST['start_limit'])?1:$_POST['start_limit'];
	$page_num=empty($_POST['page_num'])?10:$_POST['page_num'];


	$curl_url='https://www.googleapis.com/customsearch/v1element?cx=015071261457165851393:e6qtzqyrn5m&key=AIzaSyCVAXiUzRYsML1Pv6RwSG1gunmMikTzQqY&q='.$keyword.'&hl='.$hl.'&start='.$start_limit.'&num='.$page_num;
	$info=curl_test($curl_url);
	echo "<pre>";
	var_dump($info);
	echo "</pre>";
	


require_once $require_file;

?>