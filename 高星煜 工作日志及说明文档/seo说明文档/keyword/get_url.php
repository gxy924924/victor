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
    // $url = str_replace("é", '%C3%A9', $url);
    $url = str_replace("\r", '', $url);
	$url = str_replace("\n", '', $url);
	return $url;
}


//curl获取信息
function curl_get($url,$header=""){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch,CURLOPT_HTTPHEADER,$header);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 	//返回信息不直接输出
	$result = curl_exec($ch);
	$error=curl_error($ch);
	if(!empty($error)){
		var_dump($error);
	}
	curl_close($ch);
	return $result;

}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//获取关键字的url
function keyword_url_get(){

	//获取keyword值
	if(empty($_GET['keyword'])){
		$keyword="inflatable";
	}else{
		$keyword=$_GET['keyword'];
	}

	if(empty($_GET['num'])){
		$num=10;
	}else{
		$num=$_GET['num'];
	}
	if(empty($_GET['rand'])){
		$rand=1;
	}else{
		$rand=$_GET['rand'];
	}
	$keyword=trim($keyword);
	$input_keyword=urlencode($keyword);
	$url="https://www.google.com/search?hl=en&biw=1920&bih=360&site=imghp&tbm=isch&sa=1&q=".$input_keyword."&gs_l=img.3...18301.19143.0.19415.5.5.0.0.0.0.321.321.3-1.1.0....0...1.1.64.img..4.1.320...0j0i67k1.j3IF0f1wxW0&bav=on.2,or.&fp=bb91cfabd5cf8e26&dpr=1&tch=1&ech=1&psi=WdNIWYOeCsu1-AGc37eQBA.1497944929585.3";
	
	// exit;
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
		
		$result=curl_get($url,$header);
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
				$is_not_good=not_good_str($value);
				if(empty($is_not_good)){
					$cal++;
					$sql_info2=$sql->add(['pid'=>$pid,'url'=>$value]);
					
				}
				if($cal>=50){
					break;
				}
				
			}
		}

		
	}else{
		$pid=$keyword_info[0]['id'];
		
	}
	if(empty($pid)){
		exit;
	}
	$obj=$sql->settable('keyword_newurl')->where("`pid`='".$pid."'");
//随机
	if($rand==1){
		$obj=$obj->join("order by rand()");
	}
	$url_info=$obj->limit(0,$num)->select();
	$url_info['keyword']=$keyword;
	return $url_info;
}

function not_good_str($str){
	return  $info=stristr($str,'logo');
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
    //  '不是字母';
}


//获取相关url
function about_keyword_url_get(){
	if(empty($_GET['rand'])){
		$rand=1;
	}else{
		$rand=$_GET['rand'];
	}
	$keyword=$_GET['keyword'];
	$arr_keyword=explode(" ", $keyword);
	$sql_str="";
	foreach ($arr_keyword as $key => $value) {
		if(!empty($value)){
			if($key>0){
				$sql_str.=" or ";
			}
			$sql_str.="`keyword` like '%".$value."%'";
		}
	}
	$sql=new sqlHelper();
	$obj=$sql->settable('keyword_newkey_table')->where($sql_str);
	if($rand==1){
		$obj=$obj->join("order by rand()");
	}
	$about_key_info=$obj->limit(0,10)->select();

	$i=0;
	foreach ($about_key_info as $key => $value) {
		$value['keyword']=trim($value['keyword']);
		$key=str_replace(" ", "+", $value['keyword']);
		$arr_key=explode("+", $key);
		foreach ($arr_key as $k => $v) {
			$v[0]=strtoupper($v[0]);
			if($k==0){
				$key=$v."+";
			}else if($k==1){
				$key.=$v;
			}else{
				$key.="+".$v;
			}
			
		}
		if(empty($_GET['host'])){
			$host=$_SERVER['HTTP_HOST'];
		}else{
			$host=$_GET['host'];
		}
		$host=str_replace("/", "", $host);
		$key=str_replace("/", "", $key);
		$arr_url[$i]['url']="http://".$host."/".$key;
		$arr_url[$i]['keyword']=$value['keyword'];
		$i++;
	}
	return $arr_url;
}

//拼装成HTML语句
function part_section(){
	//相关链接
	$arr_url=about_keyword_url_get();
	//获取图片url
	$info=keyword_url_get();
	foreach ($info as $key => $value) {
		if(is_numeric($key)){
			$img_part[$key]="<img src='".$value['url']."' alt='".$info['keyword']."' title='".$info['keyword']."'/></br>";
		}
	}
	if(empty($arr_url)){
		$a_part="";
	}else{
		foreach ($arr_url as $key => $value) {
			$a_part[$key]="<a href='".$value['url']."' title='".$value['keyword']."'>".$value['keyword']."</a>";
		}
	}
	$arr_total['img']=$img_part;
	$arr_total['a']=$a_part;
	$arr_total['keyword']=$info['keyword'];
	return $arr_total;
}

// 拼装成大块html语句
function part_section_block(){
	$arr_total=part_section();
	$img="";
	foreach ($arr_total['img'] as $key => $value) {
		$img.=$value;
	}
	$a="";
	if(empty($arr_total['a'])){
		$a="no similar link.";
	}else{
		foreach ($arr_total['a'] as $key => $value) {
			$a.=$value." | ";
		}
	}
		
	$arr_total['img']=$img;
	$arr_total['a']=$a;
	return $arr_total;

}

//转成json
function make_json(){
	$arr_total=part_section_block();
	$json=json_encode($arr_total);
	return $json;
}



	//获取文件信息，文件内容换行符要注意是否正确。 \r  \n  \r\n
function key_file($filename,$file=""){
	$file_info=file_get_contents($file.$filename.'.txt');
	$arr=explode("\n",$file_info);
	return $arr;
	
}

//获取文件目录中的关键字并将其存入数据库
function put_key_file($filename,$file=""){
	if(!empty($_GET['key'])&&$_GET['key']=="get_key_file"){
	$sql=new sqlHelper();
	//获取文件信息
	
	$sql->settable('keyword_newkey_table');
	
	$arr_file=key_file($filename);//工具
	$count=0;
	foreach ($arr_file as $v) {
		$info=$sql->where('keyword="'.$v.'"')->select();
		if(count($info)){
		}else{
			$sql->add(['keyword'=>$v]);
			$count++;
		}
	}
	$res=$count."条文件信息导入";
	echo $res;
	}
}


// ---------------------运行时启动部分---------------------
$json=make_json();
echo $json;

// put_key_file('key');
?>