<?php 
header("Content-type: text/html; charset=utf-8"); 
set_time_limit(0);
require_once "sqlHelper.class.php";
class key{
	private $host="localhost";
	private $username="root";
	private $password="root";
	private $db="key";
	private $table="keyword";

	function curl_get_header($url){
		$ch=curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, true);        //返回头信息
		curl_setopt($ch, CURLOPT_NOBODY, true);			//不返回主体信息
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 	//返回信息不直接输出

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);	//关闭ssl验证
		// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$result = curl_exec($ch);
		$curl_error=curl_error($ch);
		if(!empty($curl_error)){
			// var_dump($curl_error);
		}
		curl_close($ch);
		$result=explode("\r\n",$result);
		foreach ($result as $k => $v) {
			$pos=strpos($v,": ") ;
			if(empty($pos)){
				$arr[$k]=$v;
				$arr['status']=$curl_error;
			}else{
				$key=substr($v,0,$pos);
				$arr[$key]=substr($v,$pos+2);

			}
		}
		return $arr;
	}

	function url_self_encode($url){
		$url = str_replace(" ", '%20', $url);
    	$url = str_replace("é", '%C3%A9', $url);
    	$url = str_replace("\r", '', $url);
    	$url = str_replace("\n", '', $url);
    	return $url;

	}


	//获取文件信息，文件内容换行符要注意是否正确。 \r  \n  \r\n
	function key_file($file,$filename){
		$file_info=file_get_contents($file.$filename.'.txt');
		$arr=explode("\n",$file_info);
		return $arr;
		
	}

	//检测url方法
	function check_url($test_url){

		// $headers=@get_headers($test_url,1);
		$headers=$this->curl_get_header($test_url);
		$arr['status']='false';
		$arr["Content-Type"]='false';
		// echo "<pre>";
		// var_dump($test_url);
		// var_dump($headers);
		// var_dump($arr);
		// echo "</pre>";
		// exit;
		if(is_array($headers)){

			if($headers[0]=="HTTP/1.1 200 OK"||$headers[0]=="HTTP/1.1 200 Ok"||$headers[0]=="HTTP/1.0 200 OK"){
				$flag1=1;
				$arr['status']=$headers[0];
			}else{
				$arr['status']=$headers[0];
				if(empty($headers[0])){
					$arr['status']=$headers['status'];
				}
			}
			if(empty($headers["Content-Type"])){
				$headers["Content-Type"]="false";
			}
			if($headers["Content-Type"]=="image/jpeg"||$headers["Content-Type"]=="image/png"){
				$flag2=1;
				$arr["Content-Type"]=$headers["Content-Type"];
			}else{
				$arr["Content-Type"]=$headers["Content-Type"];
			}
			if(empty($flag1)||empty($flag2)){
				return $arr;
			}else{
				return $ans="ok";
			}
		}else{
			return $arr;
		}
	}
}



$sql=new sqlHelper();
//获取文件信息
if(!empty($_GET['key'])&&$_GET['key']=="get_key_file"){
	$sql->settable('keyword');
	$key=new key();
	$arr_file=$key->key_file('./fr/','k');//工具
	$count=0;
	foreach ($arr_file as $v) {
		$info=$sql->where('keyword="'.$v.'"')->select();
		if(count($info)){
		}else{
			$sql->add(['keyword'=>$v]);
			$count++;
		}
	}
	echo $count."条文件信息导入";
}

//获取url信息
if(!empty($_GET['key'])&&$_GET['key']=="get_key_url"){
	$get_num=empty($_GET['num'])?0:$_GET['num'];
	$key=new key();
	$sql->settable('keyword');
	$arr_file_url=$sql->select();
	// var_dump($arr_file_url);
	$sql->settable('keyword_url');
	$count=0;
	foreach ($arr_file_url as $val) {
		$url_file_name=$val['keyword'];
		// $url_file_name= iconv('utf-8','gb2312',$url_file_name);

	//路径信息
		$file_path1='./fr/images/'.$url_file_name.".txt";
		$file_rename='./fr/images/'.$url_file_name." ok.txt";
		// var_dump($file_path1);
		if(file_exists($file_path1)){
			$url_info=$key->key_file('./fr/images/',$url_file_name);
			if(empty($url_info)){
				// $url_file_name= iconv('utf-8','gb2312',$url_file_name);
				// $url_file_name= iconv('utf-8','gb2312',$url_file_name);
				$url_info=$key->key_file('./fr/images/',$url_file_name);
			}
			foreach ($url_info as $k=>$v) {
				$url_info=urldecode($v);
				if(!empty($url_info)){
					
					if($k<$get_num||$get_num==0){
						$sql->add(['pid'=>$val['id'],'url'=>$url_info]);
						$count++;

					}
					
				}
			}
			//重命名文件，让php不会再次读取到文件
			// rename($file_path1,$file_rename);
		}
	}
	echo $count."条url导入";
}



//检测url是否合格
if(!empty($_GET['key'])&&$_GET['key']=="get_url_generate"){
	echo "<pre>";
	$key=new key();
	$sql->settable('keyword_url');
	$get_num=empty($_GET['num'])?10:$_GET['num'];
	$start_num=empty($_GET['start_num'])?0:$_GET['start_num'];
	// var_dump($start_num);
	$test_url_arr=$sql->where("`check`='0'")->limit($start_num,$get_num)->select();
	$count=0;
	// var_dump($test_url_arr);
	if(empty($test_url_arr)){
		echo "finish";
		exit;
	}
	if(is_array($test_url_arr)){

		foreach ($test_url_arr as $k=> $v) {
			$test_url=$key->url_self_encode($v['url']);
			
			$ans=$key->check_url($test_url);
			
			sleep(1);
			if(is_array($ans)){
				$ans=$key->check_url($test_url);
				sleep(1);
			}

			
			// var_dump($ans);
			if($ans=="ok"){
				$query="update keyword_url set `check`=1 where id=".$v['id'];
				$info=$sql->send_query($query);
				$count++;
			}else if(is_array($ans)){
				$query="DELETE FROM `keyword_url` WHERE id=".$v['id'];
				
				$info=$sql->send_query($query);
				$sql->settable('keyword_url_error');
				$arr=['k_id'=>$v['id'],'pid'=>$v['pid'],'url'=>$v['url'],'Content-Type'=>$ans['Content-Type'],'status'=>$ans['status']];
				
				var_dump($arr);
				
				
				$sql->add($arr);
				// $info_sql=$sql->getlastsql();
				// echo "<pre>";
				// var_dump($info_sql);
				// echo "</pre>";
			}
		}
	}
	echo $count."条已验证";
	echo "</pre>";
}




//测试工具
if(!empty($_GET['key'])&&$_GET['key']=="test"){
	$key=new key();

	$sql->settable('keyword_url');
	
	$test_url_arr=$sql->where("`check`='0'")->limit(10,5)->select();

	foreach ($test_url_arr as $k => $v) {
		$headers=$key->check_url($v['url']);
		echo "<pre>";
		var_dump($headers);
		var_dump($v['url']);
		echo "</pre>";
	}
	


}

//测试获取信息
if(!empty($_GET['key'])&&$_GET['key']=="test_show"){
	echo "<pre>";


	$sql->settable('keyword');
	$test=$sql->select();
	var_dump($test);


	// $url_file_name=$test[3]['keyword'];
	// var_dump($url_file_name);

	// $info=file_get_contents("./fr/images/".$url_file_name.".txt");
	// if(empty($info)){
		// $url_file_name=urlencode($url_file_name);
		// $url_file_name= "4buty nike damskie wyprzedaż";
		// $url_file_name=iconv("UTF-8","GB2312//IGNORE",$url_file_name);
		// $info=file_get_contents("./fr/images/".$url_file_name.".txt");
	// }

	

	
	
	// var_dump($info);
	



	$handler = opendir('./fr/images');
	while( ($filename = readdir($handler)) !== false ) 
	{
	 // //略过linux目录的名字为'.'和‘..'的文件
	 if($filename != "." && $filename != "..")
	 {  
	  //输出文件名
	   var_dump($filename) ;
	   fopen($filename,'r');
	   var_dump(base64_encode($filename));
	   // var_dump(file_get_contents($filename));
	  }
	}

		closedir($handler);



	echo "</pre>";


}




 ?>