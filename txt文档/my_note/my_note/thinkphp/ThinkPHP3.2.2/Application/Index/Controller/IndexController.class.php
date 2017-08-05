<?php
//第一步：定义命名空间
namespace Index\Controller;
//第二步：引入父类控制器
use Think\Controller;
//第三步：定义控制器并且继承父类
class IndexController extends CommonController{
	public function test2(){
		$user=M("user1");
		$this->row=$user->select();
		$this->display();
	}

	function index(){
		echo U('index')."</br>";
		$this->display();
	}
	function test(){
		echo $_GET[_URL_];
		echo U("Index");
	}
	function testa(){
		$test=A("Test");//跨模块调用
		print_r($test);
		$test->test();
	}
}