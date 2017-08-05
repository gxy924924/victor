<?php
function HmacMd5($data,$key){
// RFC 2104 HMAC implementation for php.
// Creates an md5 HMAC/
//Eliminates the need to install mhash to compute a HMAC
// Hacked by Lance Rushing (NOTE: Hacked means written)
//需要配置环境支持iconv，否则中文参数不能正常处理
$key=iconv("gbk","utf-8",$key);
$data=iconv("gbk","utf-8",$data);
$b=64;//byte legth for md5
if(strlen($key)>$b){
$key=pack("H*",md5($key));
}
$key=str_pad($key,$b,chr(0x00));
$ipad=str_pad('',$b,chr(0x36));
$opad=str_pad('',$b,chr(0x5c));
$k_ipad=$key^$ipad;
$k_opad=$key^$opad;
return md5($k_opad.pack("H*",md5($k_ipad.$data)));}

//我们易宝支付要求怎样生成一个签名串
//把各个请求参数拼接，作为$data传入：$key 就是易宝给商家分配的秘钥
$merchantKey="69cl1522AV6q613Ii4W6u8K6XuW8vM1N6bDgyv769220IuYe9u37N4y7rI4P1";
echo 'val='.HmacMd5("hello",$merchantKey);
?>