<?php 
class IndexController extends Controller{
	public function index(){
		$this->verify();
		$this->display();
	}

	function left(){
		$this->verify();
		$this->display();
	}

	function top(){
		$this->verify();
		$this->display();
	}

	function right(){
		$this->verify();
		$this->display();
	}

	function login(){
		$this->display();
	}

	function register(){
		$this->display();
	}

	function goexit(){
		unset($_SESSION['username']);
		$url=U_PATH."?c=Index&v=login";
		$this->jump("退出成功",$url);
	}

	//通过jquery的快速ajax检查用户名是否重复
	function checkusername(){	
		$user=new sqlHelper();
		$user->settable("user");
		$rows=$user->where("username='".$_POST['username']."'")->find();
		if($rows){
			echo "get";
		}
	}

	//注册好后，加数据库
	function insert(){
		$this->check($_POST['checkcode']);
		$user=new sqlHelper();
		$user->settable("user");
		echo $jieguo=$user->add($_POST);//添加并返回结果
		echo $user->getlastsql();
	}

	//检查账户名、密码是否正确
	function logincheck(){
		$this->check($_POST['checkcode']);
		$user=new sqlHelper();
		$user->settable("user");
		$rows=$user->where("username='".$_POST['username']."'")->find();
		//echo $user->getlastsql();
		if($rows[0]['password']==$_POST['password']){
			$url=U_PATH."?c=Index&v=index";
			$_SESSION['username']=$_POST['username'];
			$this->jump("登陆成功",$url);
		}else{
			$url=U_PATH."?c=Index&v=login";
			$this->jump("账号或密码错误",$url);
		}
	}

	function check($c){
		if($c!=$_SESSION['checkcode']){
			$info= "验证码错误</br>";
			$info.="你输得是".$_POST['checkcode'] ."</br>";
			$info.="应该是".$_SESSION['checkcode']."</br>";
			exit;
		}
	}

	//输出验证码
	function checkcode(){
		$checkcode=new checkcode();
		$checkcode->getimg();
	}
	function test1(){
		$this->display();
	}
}
?>