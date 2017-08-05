<?php
//第一步：定义命名空间
namespace Admin\Controller;
//第二步：引入父类控制器
use Think\Controller;
//第三步：定义控制器并且继承父类
class PublicController extends Controller {
	public function login(){
		 $this->display();
	}
	public function test(){
		//获取模板内容
		$str= $this->fetch();
		//dump打印
		dump($str);
	}
	public function test2(){
		 $this->display();
	}

}