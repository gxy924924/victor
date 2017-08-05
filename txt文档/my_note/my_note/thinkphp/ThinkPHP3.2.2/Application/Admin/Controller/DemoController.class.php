<?php
//第一步：定义命名空间
namespace Admin\Controller;
//第二步：引入父类控制器
use Think\Controller;
//第三步：定义控制器并且继承父类
class DemoController extends Controller {
	public function test(){
		 $this->display();
	}

	//使用U方法组装出另一个控制器下Index中的index方法地址，
	public function test2(){
		echo U('Index/index');
	}
	//传值
	public function test3(){
		echo U('Index/index',array('id'=>100));
	}
	//跳转：成功
	public function test4(){
		$this->success('操作成功',U('test'),10);
	}
	//跳转：失败
	public function test5(){
		$this->error('操作失败。。。。。。',U('test'),10);
	}
}