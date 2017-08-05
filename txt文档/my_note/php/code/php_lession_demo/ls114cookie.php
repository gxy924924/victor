<?php
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set('Asia/Shanghai');


//演示如何创建cookie信息
//把用户名和密码保存到客户端的cookie
//这个函数用于保存cookie  =>(cookie的一个键值，键值保存内容，保存时间（秒）)
setCookie("name","shunping",time()+3600);
if(!empty($_COOKIE['lastvisit'])){
	echo "你上次访问时间：{$_COOKIE['lastvisit']}";
	setCookie("lastvisit",date("Y-m-d H:i:s"),time()+3600);
}else{
	echo "你首次访问";
	setCookie("lastvisit",date("Y-m-d H:i:s"),time()+3600);
}
echo "保存成功";
?>