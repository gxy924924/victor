<?php 
//基本功能->curl&&relocation
set_time_limit (0); //不限时 24 * 60 * 60
function check_ip(){
	session_start();
	if(empty($_SESSION['go_in_ip'])){
		$_SESSION['go_in_ip']=$_SERVER['REMOTE_ADDR'];
		$_SESSION['web_site_id']=1;
		// var_dump($_SESSION);
		require_once "sqlHelper.class.php";
		$sql=new sqlHelper();
		$query="INSERT INTO `guest_ip_in`(`web_site_id`, `go_in_ip`) VALUES ('".$_SESSION['web_site_id']."','".$_SESSION['go_in_ip']."')";
		// var_dump($query);
		$sql_info1=$sql->send_query($query);
	}
}

function curl_get($url,$header=""){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 	//返回信息不直接输出
	$result = curl_exec($ch);
	$error=curl_error($ch);
	if(!empty($error)){
		var_dump($error);
	}
	curl_close($ch);
	return $result;
}

//判断字母大小写
function checkcase1($str){
    $str = ord($str);
    if($str>64&&$str<91){
        //  '大写字母';
        return 0;
    }
    if($str>96&&$str<123){
        //  '小写字母';
        return 1;
    }
}

//大写关键字首字母重定向
function upper_relocation($site=""){
	$up=0;
	if(!empty($_GET['keyword'])){
		$key=str_replace(" ", "+", $_GET['keyword']);
		$arr_key=explode("+", $key);
		foreach ($arr_key as $k => $v) {
			$title_word=substr($v,0,1);
			$res=checkcase1($title_word); 		//检查首字母大小写
			if(empty($res)){
				if($k==0){
					$key=$v."+";
				}else if($k==1){
					$key.=$v;
				}else{
					$key.="+".$v;
				}
			}else{
				$up=1;
				$v[0]=strtoupper($v[0]);
				if($k==0){
					$key=$v."+";
				}else if($k==1){
					$key.=$v;
				}else{
					$key.="+".$v;
				}
			}
		}
	}
	if($up==1){
		header("Location: http://".$_SERVER['HTTP_HOST']."/".$key);
	}
}

function keyword_replace($keyword){
	$not_arr=['/','\'','\"','\\'];
	foreach ($not_arr as $key => $val) {
		$keyword=str_replace($val, '', $keyword);
	}
	// $keyword=str_replace(" ", "%20", $keyword);
	
	$date=date("Y");
	for ($i=1; $i <7 ; $i++) { 
		$need_new[]=$date-$i;
	}
	foreach ($need_new as $key => $val) {
		$keyword=str_replace($val, $date, $keyword);
	}
	return $keyword;
}

//检测进入的ip
check_ip();

$site=!empty($_GET['site'])?$_GET['site'].'.html':"inflatable.html";
//重定向
upper_relocation();
// exit;
$host=$_SERVER['HTTP_HOST'];
$route="get_url.php";
$_GET['keyword']=!empty($_GET['keyword'])?$_GET['keyword']:'Inflatable';
$_GET['keyword']=keyword_replace($_GET['keyword']);
$_GET['keyword']=urlencode($_GET['keyword']);
$get="?keyword=".$_GET['keyword'];
$get=str_replace(' ', "+", $get);
$url="http://test.hbdoing.cn/".$route.$get."&host=".$host;
$json=curl_get($url);
$key_arr=json_decode($json,1);

// echo "Uppblásanlegur vatnsrennibraut";
// echo "<pre>";
// var_dump($url);
// var_dump($_GET);
// echo "</pre>";
if($site=="inflatable.html"){
	require_once $site;
}else{
	require_once $site;
}
?>
