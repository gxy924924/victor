<?php 
header("Content-type: text/html; charset=utf-8"); 

//curl 获取头

function curl_test($url,$pr_ip,$pr_port){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
	curl_setopt($ch, CURLOPT_PROXY, $pr_ip); //代理服务器地址
	curl_setopt($ch, CURLOPT_PROXYPORT, $pr_port); //代理服务器端口
	//curl_setopt($ch, CURLOPT_PROXYUSERPWD, ":"); //http代理认证帐号，username:password的格式
	curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式
	curl_setopt($ch, CURLOPT_HEADER, true);        //返回头信息
	// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD'); // HTTP request is 'HEAD'
	curl_setopt($ch, CURLOPT_NOBODY, true);			//不返回主体信息
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 	//返回信息不直接输出
	$result = curl_exec($ch);
	var_dump(curl_error($ch));
	curl_close($ch);
	foreach ($result as $k => $v) {
		$pos=strpos($v,": ") ;
		// var_dump($pos);
		if(empty($pos)){
			$arr[$k]=$v;
			// echo "<pre>";
			// var_dump($k);
			// var_dump($arr[$k]);
			// echo "</pre>";
			
		}else{
			$key=substr($v,0,$pos);
			$arr[$key]=substr($v,$pos+2);
			
		}
	}
	return $arr;
}

function my_str_replace($url){
	$url = str_replace(" ", '%20', $url);
    $url = str_replace("é", '%C3%A9', $url);
    $url = str_replace("\r", '', $url);
	$url = str_replace("\n", '', $url);
	return $url;
}

// require_once "sqlHelper.class.php";

$url="http://www.mivo.pl/data/gfx/pictures/medium/2/0/6302_1.jpg";
// $url="https://m.ocdn.eu/_m/c7c977f181b03f08743e84ba5e852223,62,37.jpg";
// $url="https://www.hao123.com";
$url=my_str_replace($url);

// $url="http://www.baidu.com";


echo "<pre>";
// $this_header = array("content-type: application/x-www-form-urlencoded;charset=UTF-8");
$ch=curl_init();
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:114.80.1.23', 'CLIENT-IP:114.80.1.23'));
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//         "Host: www.votretnfr.com",
//         "Connection: keep-alive",
//         'Expect:'
// 		)); 
// curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0');
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);



//代理
// $pr_ip="183.62.71.242";
// $pr_port=3128;
// curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
// curl_setopt($ch, CURLOPT_PROXY, $pr_ip); //代理服务器地址
// curl_setopt($ch, CURLOPT_PROXYPORT, $pr_port); //代理服务器端口
// //curl_setopt($ch, CURLOPT_PROXYUSERPWD, ":"); //http代理认证帐号，username:password的格式
// curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式


curl_setopt($ch, CURLOPT_HEADER, true);        //返回头信息
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD'); // HTTP request is 'HEAD'
curl_setopt($ch, CURLOPT_NOBODY, true);			//不返回主体信息
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 	//返回信息不直接输出
 $result = curl_exec($ch);
 var_dump(curl_error($ch));
 curl_close($ch);
$result=explode("\r\n",$result);
foreach ($result as $k => $v) {
	$pos=strpos($v,": ") ;
	// var_dump($pos);
	if(empty($pos)){
		$arr[$k]=$v;
		// echo "<pre>";
		// var_dump($k);
		// var_dump($arr[$k]);
		// echo "</pre>";
		
	}else{
		$key=substr($v,0,$pos);
		$arr[$key]=substr($v,$pos+2);
		
	}
}

	
	var_dump($arr);
	var_dump($url);
	var_dump(getallheaders());
	echo "</pre>";
	// var_dump($url);
?>