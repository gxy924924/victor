<?php
class Controller{
//展示视图方法
	function display(){
		$file=CURR_VIEW_PATH.VIEW.".php";
		//echo $file;
		require_once $file;
	}
//跳转页-返回值，跳转位置
	function jump($res,$url){
		$this->res=$res;
		$this->url=$url;
		require_once PUBLIC_PATH."jump.php";
	}
//登录验证
	function verify(){
		if(empty($_SESSION['username'])){
			$url=U_PATH."?c=Index&v=login";
			$this->jump("您未登陆",$url);
			exit;
		}
	}
}

?>