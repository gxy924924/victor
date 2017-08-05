<!--php-->
<?php
//获取REFERER
if(isset($_SERVER['HTTP_REFERER'])){
//取出来
//判断$_SERVER['HTTP_REFERER']是不是以Referer:http://localhost开始
	//strpos($a,"aa")判断aa在$a中首次出现是在第几个字符
	if(strpos($_SERVER['HTTP_REFERER'],"http://localhost")==0){
	}else{
		//跳到警告页面
		header("Location:http://localhost/warning.php");
	}
}
else{
		//跳到警告页面
		header("Location:http://localhost/warning.php");
}

echo "通过防盗链，正常进入。。。";

?>

