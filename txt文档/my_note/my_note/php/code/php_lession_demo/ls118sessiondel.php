<?php
header("Content-type:text/html;charset=utf-8");
echo "演示如何删除session";
//1.初始化session
session_start();
//删除一个键值对
//unset($_SESSION['name']);

//删除所有的key<==>val
//这样就会把当前这个浏览器对应的session文件删除
session_destroy();

echo "</br>删除session成功！";

?>