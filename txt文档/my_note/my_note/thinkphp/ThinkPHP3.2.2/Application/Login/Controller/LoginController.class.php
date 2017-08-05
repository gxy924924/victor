<?php
//第一步：定义命名空间
namespace Login\Controller;
//第二步：引入父类控制器
use Think\Controller;
//第三步：定义控制器并且继承父类
class LoginController extends Controller{
	function index(){
		//echo session_name();//PHPSESSID 
		$this->display();
	}
	function logout(){
		session(null);
		session('[destroy]');
		cookie(session_name(),null);//PHPSESSID 
		$this->success('退出成功',U('Login/index'));
	}
	function check(){
		$user=M('User');
		$row=$user->where($_POST)->find();
		//echo $user->getLastSql();
		//echo "<pre>";print_r($row);echo "</pre>";
		if($row){
			//echo "ok";
			session('username',$_POST['username']);
			session('login',1);
			$this->success('登陆成功',U('Index/index'));
		}else{
			//echo "no!nono!";
			$this->error('账号或密码错误',U('index'));
		}
	}

	function register(){
		$this->display();
	}
	function insert(){

		$user=D('User');
		if(!$this->verify_check($_POST['fcode'])){
			$this->error('验证码错误',U('Login/register'));
		}
		if($user->create()){
			if($user->add()){
			session('username','$user->username');
			session('login',1);
			$this->success('注册成功',U('Index/index'));
			}
		}else{
			echo "<pre>";
			print_r($user->getError());
			echo "<pre>";
		}

	}
	function verify(){
		$varify = new \Think\Verify();
		$varify->fontSize=13;
		$varify->length=4;
		$varify->imageH=28;
		$varify->imageW=90;
		$varify->entry();
	}
	function verify_check($code){
		$varify = new \Think\Verify();
		return $varify->check($code);
	}
}