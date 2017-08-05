<?php
header("Content-type:text/html;charset=utf-8");
$checkCode="";
for($i=0;$i<4;$i++){
	//随机选1个1-15的数并转成16进制
	$checkCode.=dechex(rand(1,15));
}
//session_start();
//$_SESSION['myCheckCode']=$checkCode;
echo $checkCode;
?>