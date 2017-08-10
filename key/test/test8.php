<style type="text/css">
textarea{
	width: 800;
	height:500;

}

</style>

<?php 
header("Content-type: text/html; charset=gb2312"); 

function curl_get($url){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); //不进行ssl认证

	// curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
	// curl_setopt($ch, CURLOPT_PROXY, $pr_ip); //代理服务器地址
	// curl_setopt($ch, CURLOPT_PROXYPORT, $pr_port); //代理服务器端口
	// //curl_setopt($ch, CURLOPT_PROXYUSERPWD, ":"); //http代理认证帐号，username:password的格式
	// curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式

	// $headers['CLIENT-IP'] = $pr_ip; 

	// $headers['X-FORWARDED-FOR'] = $pr_ip;

	// curl_setopt ($ch, CURLOPT_HTTPHEADER , $headers );  //构造IP
	// curl_setopt ($ch, CURLOPT_REFERER, "http://www.163.com/ ");   //构造来路


	// curl_setopt($ch, CURLOPT_HEADER, true);        //返回头信息
	// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD'); // HTTP request is 'HEAD'
	// curl_setopt($ch, CURLOPT_NOBODY, true);			//不返回主体信息
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 	//返回信息不直接输出
	$result = curl_exec($ch);
	var_dump(curl_error($ch));
	curl_close($ch);
	return $result;

}

$url="http://www.biqugex.com/book_265/310084.html";
$result=curl_get($url);

echo "<textarea>";
var_dump($result);
echo "</textarea>";
?>