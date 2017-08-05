<!--php异常处理/错误处理2-->
<?php
//写一个函数（$a,$b）括弧内名字随意
function my_error($errno,$errmes){
	echo "<font size='5' color='red'>$errno</font><br/>";
	$err_info="my_error1错误信息：$errmes";
	echo $err_info;
	error_log($err_info."\r\n",3,"myerr.txt");
	exit();
}
function my_error2($errno,$errmes){
	date_default_timezone_set('Asia/Shanghai');
	echo "<font size='5' color='red'>$errno</font><br/>";
	$err_info=date("Y年m月d日 G:i:s")."my_error2错误信息：$errmes";
	echo $err_info;
	error_log($err_info."\r\n",3,"myerr.txt");
	exit();
}

 
//改写set_error_handler处理器//,E_USER_NOTICE  //,E_USER_WARNING
set_error_handler("my_error",E_USER_NOTICE );
set_error_handler("my_error2",E_USER_WARNING);

$age=700;
if($age>120){
//错误触发器 默认是E_USER_NOTICE
trigger_error("输入年龄过大",E_USER_WARNING);
//exit();
}
echo "年龄=".$age;
?>

