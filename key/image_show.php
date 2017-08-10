<?php 
header("Content-type: text/html; charset=utf-8"); 
require_once "sqlHelper.class.php";
set_time_limit(0);
//分类刷图片入库————————————————————————————————————————————————————————————————————

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
echo "<pre>";
	
	if(empty($_GET['keyword'])){
		$before_info= "未输入需求，或需求输入不足";
		require_once $require_file;
		exit;
	}

	//初始化数据
	// $hl=$_GET['language'];
	$keyword=$_GET['keyword'];
	$start_limit=empty($_GET['start_limit'])?0:$_GET['start_limit']-1;
	$page_num=empty($_GET['page_num'])?10:$_GET['page_num'];
	$content='';


	// $curl_url='https://www.googleapis.com/customsearch/v1element?cx=015071261457165851393:e6qtzqyrn5m&key=AIzaSyCVAXiUzRYsML1Pv6RwSG1gunmMikTzQqY&q='.$keyword.'&hl='.$hl.'&start='.$start_limit.'&num='.$page_num;
	// $info=curl_test($curl_url);

	$sql=new sqlHelper();
	$keyword_info=$sql->settable('keyword')->select();

	$keyword_url_info=$sql->set_query('select keyword_url.*,keyword.keyword from keyword_url left join keyword on keyword_url.pid=keyword.id where `keyword` like "%'.$keyword.'%" order by rand() limit '.$start_limit*$page_num.','.$page_num)->select();
	var_dump($sql->getlastsql());
	if(empty($keyword_url_info[0])){

	}else{
		$_GET['keyword']=ucfirst($_GET['keyword']);
		$_GET['keyword']=str_replace(' ', '+', $_GET['keyword']);
		
		// $page_url=implode('/', $_GET);

		// $page_url=$_SERVER['QUERY_STRING'];

		foreach($keyword_url_info as $key=>$val){
			$image_id_arr[$key]=$val['id'];
			
		}
		$page_url=$_GET['keyword'];
		$iamge_id=implode(',', $image_id_arr);
		$keyword_id=$keyword_url_info[0]['pid'];

	//拼接
		$page_arr[0]="'".$page_url."'";
		$page_arr[1]="'".$iamge_id."'";
		$page_arr[2]="'".$keyword_id."'";
		$page_input=implode(',', $page_arr);

		$page_info=$sql->add('insert into `keyword_page` (page_url,images_id,keyword_id) values ('.$page_input.')');
	}

	


	
	// var_dump($page_url);
	var_dump($sql->getlastsql());
	// var_dump($keyword_url_info);
	echo "</pre>";
	


require_once $require_file;

?>