<!--php-->
<?php

//print_r($_SERVER);//$_SERVER是一个数组
foreach($_SERVER as $key=>$val){
	echo "$key=$val </br>";
}
//可以指定取出访问该页面的ip
echo "your ip :".$_SERVER['REMOTE_ADDR'];

//不让指定的ip进入页面
/*
if($_SERVER['REMOTE_ADDR']=="127.0.0.1"){
//跳转到一个警告页面
header("Location:ls81.php");
}
*/
?>

