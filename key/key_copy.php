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


	function key_file($file,$filename){
		$file_info=file_get_contents($file.$filename.'.txt');
		$arr=explode("\r\n",$file_info);
		return $arr;
		
	}

	function check_url($test_url){

		$headers=@get_headers($test_url);

		if(is_array($headers)){
			foreach ($headers as  $val) {
				if($val=="HTTP/1.1 200 OK"){
					$flag1=1;
				}
				if($val=="Content-Type: image/jpeg"){
					$flag2=1;
				}
				if(empty($flag1)||empty($flag2)){

				}else{
					return $ans="ok";

				}
			}
		}
	}
}



$sql=new sqlHelper();
//获取文件信息
if(!empty($_GET['key'])&&$_GET['key']=="get_key_file"){
	$sql->settable('keyword');
	$key=new key();
	$arr_file=$key->key_file('./fr/','k');
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
	//路径信息
		$file_path1='./fr/images/'.$url_file_name.".txt";
		$file_rename='./fr/images/'.$url_file_name." ok.txt";
		// var_dump($file_path1);
		if(file_exists($file_path1)){
			$url_info=$key->key_file('./fr/images/',$url_file_name);
			foreach ($url_info as $k=>$v) {
				$url_info=urldecode($v);
				if(!empty($url_info)){
					
					if($k<$get_num||$get_num==0){
						$sql->add(['pid'=>$val['id'],'url'=>$url_info]);
						$count++;

					}
					
				}
			}
			rename($file_path1,$file_rename);
		}
	}
	echo $count."条url导入";
}



//检测url是否合格
if(!empty($_GET['key'])&&$_GET['key']=="get_url_generate"){
	$key=new key();
	$sql->settable('keyword_url');
	$get_num=empty($_GET['num'])?10:$_GET['num'];
	$start_num=empty($_GET['start_num'])?0:$_GET['start_num'];
	// var_dump($start_num);
	$test_url_arr=$sql->where("`check`='0'")->limit($start_num,$get_num)->select();
	$count=0;
	// var_dump($get_num);
	if(empty($test_url_arr)){
		echo "finish";
		exit;
	}
	if(is_array($test_url_arr)){

		foreach ($test_url_arr as $k=> $v) {
			$test_url=$v['url'];
			
			$ans=" not ";
			$i=0;
			while ($ans!= "ok"&&$i<3) {
				$ans=$key->check_url($test_url);
				$i++;
			}
			
	
			if($ans=="ok"){
				$query="update keyword_url set `check`=1 where id=".$v['id'];
				$info=$sql->send_query($query);
				$count++;
			}else{
				$query="DELETE FROM `keyword_url` WHERE id=".$v['id'];
				
				$info=$sql->send_query($query);
				$sql->settable('keyword_url_error');
				$sql->add(['pid'=>$v['pid'],'url'=>$v['url']]);
			}
		}
	}
	echo $count."条已验证";
}



if(!empty($_GET['key'])&&$_GET['key']=="test"){


	$sql->settable('keyword_url');
	
	$test_url_arr=$sql->where("`check`='0'")->limit(0,5)->select();

}




 ?>