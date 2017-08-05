<?php
//第一步：定义命名空间
namespace Login\Controller;
//第二步：引入父类控制器
use Think\Controller;
//第三步：定义控制器并且继承父类
class IndexController extends Controller{
	function acl(){		//权限验证功能
		if(!session('login')){
			$this->error('您未登陆',U('login/index'));
			exit;
		}
		$this->username=session('username');
	}
	function index(){
		$this->acl();//验证

		//分页功能
		$test=M('test');
		$count=$test->count();//获得数据总条数
		$this->listrows=10;
		$page=new \Think\Page($count,$this->listrows);//初始化，（总条数，单页条数）
		$page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');//设置显示那些项目
		$page->setConfig('header','<span class="rows">共 %TOTAL_PAGE% 页</span>');
		// 进行分页数据查询
		$this->show=$page->show();//分页连接部分
		$this->rows=$test->page($page->nowPage,$this->listrows)->select();

		$this->display();
	}
	function show(){
		$this->acl();
		$this->display();
	}
	function upload(){
		//文件上传
		$up=new \Think\Upload();// 实例化上传类
		$up->savePath = './Upload/';//设置上传目录
		$up->rootPath='./Public/';//上传根目录
		// 上传文件 
		$info   =   $up->upload();
		if(!$info) {// 上传错误提示错误信息
			echo $up->getError();
		}else{// 上传成功 获取上传文件信息    
			echo "<pre>";
			print_r($info);
			echo "</pre>";
		}
	}
	function cookie_show(){
		echo "<pre>";
		print_r($_COOKIE);
		echo "</pre>";
	}
	function cookie_del(){
		//var_dump(cookie(null));
		var_dump(cookie('name',null));
	}
	function cookie_set(){
		var_dump(cookie('name','aaa'));
	}
	function img_control(){
		$image = new \Think\Image(); 
		$image->open("./Public/image/1.png");//根目录相当于是在index.php文件所在位置
		//水印
		//$image->water('./Public/image/aa.png')->save("water.gif");//将原图进行添加水印的处理，以aa.png为水印，并生成结果图water.gif
		//缩略图
		$image->thumb(100,100)->save("./Public/image/T1.jpg");//生成缩略图
	}
	function test_sql(){
		$test=M('test');
		$count=$test->count();
		$this->listrows=10;//设置显示多少行
		$page=new \Think\Page($count,$this->listrows);
		//$page=$test->page(1,10)->select();
		//echo "<pre>";var_dump($page);echo "</pre>";
		//var_dump($show=$page->show());
		// 进行分页数据查询
		$show=$page->show();
		$rows=$test->page($page->nowPage,$this->listrows)->select();
		echo "<pre>";
		print_r($rows);
		echo "</pre>";
		echo $show;
	}
}