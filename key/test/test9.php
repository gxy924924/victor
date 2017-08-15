<?php 
// header("Content-type: text/html; charset=utf-8"); 

//curl获取信息
function curl_get($url,$header=""){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	if(!empty($header)){
		curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
	}
	// 

	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 	//返回信息不直接输出
	$result = curl_exec($ch);
	$error=curl_error($ch);
	if(!empty($error)){
		var_dump($error);
	}
	curl_close($ch);
	return $result;

}

// $info="http:\/\/henrydavidsen.com\/wp-content\/uploads\/2013\/02\/ photo631.jpg ";
// $info=str_replace('\\/', "/", $info);

// $length=strlen($info);

// $str=trim($info);
//显示server
// $a="php吙煋呅";
$sp="Brinquedos insufláveis de diversão";
$sp=urlencode($sp);
$a="http://testkey.com/test/test10.php?test=".$sp;


$b=curl_get($a);
$b=urldecode($b);
echo "<pre>";
// var_dump($_SERVER);
// var_dump($a);
// $a=urlencode($a);
// var_dump($a);
// $a=urldecode($a);

var_dump($b);
echo "</pre>";
?>