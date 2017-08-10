<?php 
require_once "sqlHelper.class.php";
header("Content-type: text/html; charset=utf-8"); 
set_time_limit (0); //不限时 24 * 60 * 60
//curl 获取头
//-----------------------------------------------从curl获取api链接信息---------------------------


//正则表达式获取相应得url
function preg_match_url($string){

	// preg_match_all("/http.*?(.png|.jpg|.jpeg)/", $string, $arr);
	preg_match_all("/http.*?(.jpg|.jpeg)/", $string, $arr);
	$i=0;
	foreach ($arr[0] as $key => $val) {
		if(strlen($val)>500){

		}else{
			$val=str_replace('\\/', "/", $val);
			$arr2[$i]=$val;
			$i++;
		}
	}
	return $arr2;
}

//url基本替换
function my_str_replace($url){
	$url = str_replace(" ", '%20', $url);
    $url = str_replace("é", '%C3%A9', $url);
    $url = str_replace("\r", '', $url);
	$url = str_replace("\n", '', $url);
	return $url;
}


//curl获取信息
function curl_get($url,$pr_ip=0,$pr_port=0,$header){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //信任任何证书
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // 检查证书中是否设置域名,0不验证

	// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch,CURLOPT_HTTPHEADER,$header);

	if($pr_ip!=0){
		curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
		curl_setopt($ch, CURLOPT_PROXY, $pr_ip); //代理服务器地址
		curl_setopt($ch, CURLOPT_PROXYPORT, $pr_port); //代理服务器端口
		//curl_setopt($ch, CURLOPT_PROXYUSERPWD, ":"); //http代理认证帐号，username:password的格式
		curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式
	}
	curl_setopt($ch, CURLOPT_REFERER, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); //允许重定向

	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 	//返回信息不直接输出
	$result = curl_exec($ch);
	var_dump(curl_error($ch));
	curl_close($ch);
	return $result;

}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function keyword_url_get(){

	//获取keyword值
	if(empty($_GET['keyword'])){
		$keyword="addidas";
	}else{
		$keyword=$_GET['keyword'];
	}

	if(empty($_GET['num'])){
		$num=30;
	}else{
		$num=$_GET['num'];
	}
	$url="https://www.google.com/search?hl=en&biw=1920&bih=360&site=imghp&tbm=isch&sa=1&q=".$keyword."&gs_l=img.3...18301.19143.0.19415.5.5.0.0.0.0.321.321.3-1.1.0....0...1.1.64.img..4.1.320...0j0i67k1.j3IF0f1wxW0&bav=on.2,or.&fp=bb91cfabd5cf8e26&dpr=1&tch=1&ech=1&psi=WdNIWYOeCsu1-AGc37eQBA.1497944929585.3";
	$header=array(  
		"Host: www.google.com",  
		"User-Agent: Mozilla/5.0 (Windows NT 6.1; … Gecko/20100101 Firefox/54.0",  
		"Accept: text/html;q=0.9,*/*;q=0.8", 
		"Accept-Charset:utf-8;q=0.7,*;q=0.7",
		"Accept-Language: en-US,en;q=0.5",
		); 
	$sql=new sqlHelper();
	$keyword_info=$sql->settable('keyword_newkey')->where("`keyword`='".$keyword."'")->select();

	if(empty($keyword_info[0])){
		$url=my_str_replace($url);
		$result=curl_get($url,"127.0.0.1","1080",$header);

		$arr2=preg_match_url($result);
		if(!empty($arr2[0])){
			$keyword_key=md5($keyword);
			$sql_info1=$sql->settable('keyword_newkey')->add(['keyword'=>$keyword,'keyword_key'=>$keyword_key]);
			$keyword_info=$sql->settable('keyword_newkey')->where("`keyword`='".$keyword."'")->select();
			$sql->settable('keyword_newurl');
			$pid=$keyword_info[0]['id'];
			$cal=0;
			foreach ($arr2 as $key => $value) {
				//进行某些图片的校验，并只取得50张图
				if(empty(not_good_str($value))){
					$cal++;
					$sql_info2=$sql->add(['pid'=>$pid,'url'=>$value]);
					
				}
				if($cal>=50){
					break;
				}
				
			}
		}

		// echo "empty</br>";
	}else{
		$pid=$keyword_info[0]['id'];
		// echo "yes</br>";
	}
// $result=curl_put_file($url,"127.0.0.1","1080");
	if(empty($pid)){
		exit;
	}
	$obj=$sql->settable('keyword_newurl')->where("`pid`='".$pid."'");
//随机
	if(!empty($_GET['rand'])){
		$obj=$obj->join("order by rand()");
	}
	$url_info=$obj->limit(0,$num)->select();
	$url_info['keyword']=$keyword;
	return $url_info;
}

//查找相关字符
function not_good_str($str){
	return  $info=stristr($str,'logo');
}

//判断字母大小写
function checkcase1($str){
    $str = ord($str);
    if($str>64&&$str<91){
        // echo '大写字母';
        return 0;
    }
    if($str>96&&$str<123){
        echo '小写字母';
        return 1;
    }
    // echo '不是字母';
}

if(!empty($_GET['keyword'])){
	$str=$_GET['keyword'][0];
	$res=checkcase1($str); 		//检查首字母大小写
	if(empty($res)){

	}else{
		$key=str_replace(" ", "+", $_GET['keyword']);
		header("Location: http://".$_SERVER['HTTP_HOST']."/".$key);
	}
}
// $url="https://images-na.ssl-images-amazon.com/images/G/01/2016-adidas/Badge_of_Sport_Logo_BWp._V279056740_.jpg";

// var_dump(not_good_str($url));
	// echo "<pre>";
	// // var_dump("关键字：".$keyword);
	// // var_dump($keyword_info);
	// // var_dump($url_info);
	// // // var_dump($url);
	// // // var_dump($result) ;
	// // if(!empty($arr2)) var_dump($arr2) ;
	// var_dump($info);
	// echo "</pre>";
	
?>