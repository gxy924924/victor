<?php 
class UserController extends Controller{
	//查询
	public function index(){
		$this->verify();
		$user=new sqlHelper();
		$user->settable("user");
		$totalrow=$user->sqlcount();//查表得到总行数
		$listrows=2;				//每页显示的行数
		$page=new Page($totalrow,$listrows);	//分页类
		$url=$_SERVER['REQUEST_URI'];
		$page->url_set($url);
		$this->rows=$user->page($page->pagenow,$listrows);//分页中当前页内容
		$this->show=$page->show();			//输出分页结果
		$this->display();
	}

	//增加
	function add(){
		$this->verify();
		$this->display();
	}

	//修改
	function edit(){
		$this->verify();
		//echo $_GET['id'];
		$user=new sqlHelper();
		$user->settable("user");
		$this->rows=$user->find($_GET['id']);
		$this->display();
	}


	
	//insert	添加用户
	function insert(){
		if($_POST['checkcode']!=$_SESSION['checkcode']){
			echo "验证码错误</br>";
			echo "你输得是".$_POST['checkcode'] ."</br>";
			echo "应该是".$_SESSION['checkcode']."</br>";
			return 0;
		}
		$user=new sqlHelper();
		$user->settable("user");
		echo $jieguo=$user->add($_POST);//添加并返回结果
		echo $user->getlastsql();
	}

	//update 修改用户
	function update(){
		$user=new sqlHelper();
		$user->settable("user");
		echo $jieguo=$user->update($_POST);
		echo $user->getlastsql();
	}

	//删除用户
	function delete(){
		$user=new sqlHelper();
		$user->settable("user");
		echo $jieguo=$user->delete("id=".$_GET['id']);
		echo $user->getlastsql();
	}
	
	//
	function checkcode(){
		$checkcode=new checkcode();
		$checkcode->getimg();
	}

	function test(){
		$user=new sqlHelper();
		$user->settable("user");
		$totalrow=$user->sqlcount();//查表得到总行数
		$listrows=2;				//每页显示的行数
		$page=new Page($totalrow,$listrows);
		$page->url_set("./IndexController.class.php");
		//$rows=$user->select("limit 1,2");
		$this->rows=$user->page($page->pagenow,$listrows);
		//$rows=$user->find();
		echo $page->show();			//输出分页结果
		echo $user->getlastsql();
		$this->display();
	}
	
}
?>