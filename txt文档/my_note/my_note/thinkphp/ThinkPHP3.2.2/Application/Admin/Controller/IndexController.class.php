<?php
//第一步：定义命名空间
namespace Admin\Controller;
//第二步：引入父类控制器
use Think\Controller;
//第三步：定义控制器并且继承父类
class IndexController extends Controller {
	public function test2(){
		$user=M("user1");
		$this->row=$user->select();
		$this->display();
	}
}