<?php

function lastVisitTime(){
    header("Content-type:text/html;charset=utf-8");
    date_default_timezone_set('Asia/Shanghai');
    if(!empty($_COOKIE['lastvisit'])){
        echo "你上次访问时间（10天内）：{$_COOKIE['lastvisit']}";
        //86400秒为一天，有效期10天
        setCookie("lastvisit",date("Y-m-d H:i:s"),time()+864000);
    }else{
	    echo "你首次访问";
    	setCookie("lastvisit",date("Y-m-d H:i:s"),time()+864000);
    }
}
//获取cookie值
function getCookieVal($val){
    if (empty($_COOKIE[$val])){
        echo "";
    }else {
        echo $_COOKIE[$val];
    }
}
//验证用户session值合法
function checkUserValidate(){
    session_start();
    if (empty($_SESSION['name'])){
        header("Location:login.php?errno=1");
    }
}
//获取验证码
function getCheckCode(){
    $checkCode="";
    for($i=0;$i<4;$i++){
        //随机选1个1-15的数并转成16进制
        $checkCode.=dechex(rand(1,15));
    }
    session_start();
    $_SESSION['checkCode']=$checkCode;
    echo $checkCode;
}
//
function errnoReturn($errno){
        if ($errno==1){
            echo "<font color='red'>用户名错误</font>";
        }else if ($errno==2){
            echo "<font color='red'>密码错误</font>";
        }else if ($errno==3){
            echo "<font color='red'>验证码错误</font>";
        }
}
?>