<?php 
header("Content-type: text/html; charset=utf-8"); 

//数据库测试

require_once "sqlHelper.class.php";


	echo "<pre>";

// $sql=new sqlHelper();
// 	$sql->settable('keyword');
// 	$test=$sql->select();
// 	$base=base64_encode($test[3]['keyword']);
// 	var_dump($test[3]['keyword']);
// 	var_dump($base);


$handler = opendir('./fr/images');
$i=0;
	while( ($filename = readdir($handler)) !== false ) 
	{
	 // //略过linux目录的名字为'.'和‘..'的文件
	 if($filename != "." && $filename != ".."&&$i<80&&$i>29)
	 {  
	  //输出文件名
	 	// $filename=iconv("ASCII","utf-8",$filename);
	 	$filename= mb_convert_encoding($filename,"utf-8","ASCII");
	 $file_code_type=mb_detect_encoding($filename);
	 var_dump($file_code_type);
	   var_dump($filename) ;
	   // fopen($filename,'r');
	   // var_dump(base64_encode($filename));
	   // var_dump(file_get_contents($filename));
	  }
	  $i++;
	}

		closedir($handler);


	echo "</pre>";


// ord();
// chr(); //该函数用于将字符串转化为ASCII码值。
?>