<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
		$user=M('user3','','mysql://root:root@localhost/test');
		//$user=M('User');
		$count=$user->count();
		$this->listrows=20;
		$page=new \Think\Page($count,$this->listrows);//初始化，（总条数，单页条数）
		$page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
				//设置显示那些项目
		$page->setConfig('header','<span class="rows">共%TOTAL_PAGE%页,当前第%NOW_PAGE%页</span>');
				// 进行分页数据查询
		$this->show=$page->show();//分页连接部分（显示分页链接）
		$this->rows=$user->page($page->nowPage,$this->listrows)->select();
		$this->display();
    }
	function add(){
		$this->display();
	}
	function insert(){
		
	}
	function edit(){
		echo "<pre>";
		var_dump($_SESSION);
		echo "</pre>";
	}
	function update(){
		$id=$_GET['id'];
		$this->success("$id",U('User/index'));
		//echo U('User/index');
	}
	function mydelete(){
		$id=$_GET['id'];
		$user=M('user3','','mysql://root:root@localhost/test');
		if($user->delete($id)){
			$this->success('删除成功',U('User/index'));
		}
	}
	function test(){
		echo intval(0.58*100000);
	}
}