<?php 
header("Content-type: text/html; charset=utf-8"); 

//代理服务器验证工具
// require_once "sqlHelper.class.php";
set_time_limit(0);


function curl_test($url,$pr_ip,$pr_port){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); //不进行ssl认证

	curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
	curl_setopt($ch, CURLOPT_PROXY, $pr_ip); //代理服务器地址
	curl_setopt($ch, CURLOPT_PROXYPORT, $pr_port); //代理服务器端口
	//curl_setopt($ch, CURLOPT_PROXYUSERPWD, ":"); //http代理认证帐号，username:password的格式
	curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式

	$headers['CLIENT-IP'] = $pr_ip; 

	$headers['X-FORWARDED-FOR'] = $pr_ip;

	curl_setopt ($ch, CURLOPT_HTTPHEADER , $headers );  //构造IP
	curl_setopt ($ch, CURLOPT_REFERER, "http://www.163.com/ ");   //构造来路


	curl_setopt($ch, CURLOPT_HEADER, true);        //返回头信息
	// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD'); // HTTP request is 'HEAD'
	curl_setopt($ch, CURLOPT_NOBODY, true);			//不返回主体信息
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 	//返回信息不直接输出
	$result = curl_exec($ch);
	var_dump(curl_error($ch));
	curl_close($ch);
	if(!empty($result)){
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
	}
	if(empty($arr)){
		return $arr[0]=false;
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




$url="http://www.mivo.pl/data/gfx/pictures/medium/2/0/6302_1.jpg";
// $url="https://m.ocdn.eu/_m/c7c977f181b03f08743e84ba5e852223,62,37.jpg";
// $url="https://www.hao123.com";
$url=my_str_replace($url);
	echo "<pre>";
	var_dump($url);
	echo "</pre>";

$arr=["183.62.71.242:3128","183.131.19.233:3128","183.62.196.10:3128"];



foreach ($arr as  $val) {
	// $val=$arr[0];
	$arr1=explode(':', $val);
	$info=curl_test($url,$arr1[0],$arr1[1]);
	echo "<pre>";
	var_dump($val);
	var_dump($info);
	// var_dump($url);
	var_dump(getallheaders());
	echo "</pre>";
}


