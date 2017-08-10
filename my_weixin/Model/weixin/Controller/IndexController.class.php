<?php 
//wx model
class IndexController extends Controller{
	function index(){
		echo "index";
		$this->display();
	}
	function weixinchat(){
		header("Content-Type:text/html; charset=utf-8");
		if(!empty($_GET["echostr"])){
			define("TOKEN", "weixin");
			$wecheckObj=new weicheck();
			$wecheckObj->valid();
		}else{
			$wechatObj=new weichat();
			$wechatObj->responseMsg();
		}
	}

	function weixin_userinfo(){
		if (!empty($_GET['code'])) {
			$wx_web=new wx_web($_GET['code']);
			$res=$wx_web->get_userinfo();
		}
		echo "<pre>";
		var_dump($_GET);
		// var_dump($res);
		echo "</pre>";
		$this->display();
	}

	function get_actoken(){
		$wx_menu=new wx_menu();
		$res=$wx_menu->get_acToken();
		echo "<pre>";
		var_dump($res);
		echo "</pre>";
	}

	function weixin_menu(){
		// header("Content-type:text/html;charset=utf-8");
		

		$this->display();
	}

	function weixin_menu_action(){
		$wx_menu=new wx_menu();
		$action_name=$_GET['act'];
		echo $action_name;
		$res=$wx_menu->$action_name();
		var_dump($res);
	}

	function sql_test(){
		$sql=new sqlHelper();
		$res=$sql->select();
		echo "<pre>";
		var_dump($res);
		echo "</pre>";
	}
	function get_qrcode(){
		require_once PUBLIC_PATH.'/phpqrcode/phpqrcode.php';
		QRcode::png('http://web/Mywork_www/index.php');   
	}

	function jump_test(){

		$this->jump("","",-1);
	}
}
?>