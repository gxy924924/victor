<!--php异常处理/错误处理2-->
<?php
//写一个函数（$a,$b）括弧内名字随意
function my_error($errno,$errmes){
	echo "<font size='5' color='red'>$errno</font><br/>";
	echo "错误信息：$errmes";
	exit();
}

//改写set_error_handler处理器,E_WARNING   //,E_USER_NOTICE
set_error_handler("my_error",E_WARNING  );

$fp=fopen("aa.txt","r")

//原版错误：
//Warning: fopen(aa.txt): failed to open stream: No such file or directory in D:\web\www\ls79err.php on line 13

//改写后：
//2
//错误信息：fopen(aa.txt): failed to open stream: No such file or directory

?>

