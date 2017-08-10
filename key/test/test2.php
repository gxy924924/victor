<?php 
header("Content-type: text/html; charset=utf-8"); 

//socket获取头


// $url=$_SERVER['PHP_SELF'];
// $pos=strrpos($_SERVER['PHP_SELF'],"/") ;
// $url=substr($_SERVER['PHP_SELF'], 0,strrpos($_SERVER['PHP_SELF'],"/")+1);



// $url="https://www.baidu.com/s?ie=utf-8&f=8&rsv_bp=0&rsv_idx=1&ch=8&tn=98010089_dg&wd=fsockopen&rsv_pq=d894225e00000165&rsv_t=db25b5gWBtMRePm8WaMVOvBvlWG7BVAy0Ne%2F3KLWFbHETT76Z4%2BEeCz%2BYtf9lJ67dsU&rqlang=cn&rsv_enter=1&rsv_n=2&rsv_sug3=1";
$url='http://branded.vxm.pl/jordan_4_granatowo_pomaranczowe_2.jpg';
$url_pieces = parse_url($url);

$path =(isset($url_pieces['path']))?$url_pieces['path']:'/';  
$port =(isset($url_pieces['port']))?$url_pieces['port']:'80'; 

$fp =fsockopen($url_pieces['host'],$port,$errno,$errstr,30);

$send = "HEAD $path HTTP/1.1\r\n";  
$send .= "HOST:".$url_pieces['host']."\r\n";  
$send .= "CONNECTION: CLOSE\r\n\r\n";  

fwrite($fp,$send);  
//检索HTTP状态码  
$data = fgets($fp,128);
fclose($fp);  



echo "<pre>";

var_dump($path);
var_dump($port);
var_dump($url_pieces);
var_dump($send);
var_dump($data);
// var_dump($pos);
// var_dump($_SERVER);



echo "</pre>";


?>