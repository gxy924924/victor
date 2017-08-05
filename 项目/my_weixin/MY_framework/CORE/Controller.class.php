<?php
class Controller{
//展示视图方法
	function display(){
		$file=CURR_VIEW_PATH.VIEW.".php";
		require_once $file;
		
	}

	function catch_play($time=300){
		// echo "</br></br></br></br>";
		$adder=empty($_GET['type_id']) ? "": "-".$_GET['type_id'];
		$adder.=empty($_GET['id']) ? "": "-".$_GET['id'];
		$this->catch_file=CURR_VIEW_PATH."catch\\".VIEW.$adder.".html";
		// echo "</br>".$this->catch_file;
		if(file_exists($this->catch_file)){
			//刷新缓存功能
			if (!empty($_GET['new_catch'])||filemtime($this->catch_file)+$time<time()) {
				return true;
			}
			// echo "</br>catch_play";
			require_once $this->catch_file;
			return false;
		}else{
			return true;
		}

	}

//跳转页-返回值，跳转位置
	function jump($res,$url,$time=5){
		$this->res=$res;
		$this->url=$url;
		$this->time=$time;
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