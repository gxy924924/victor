<?php
//第一步：定义命名空间
namespace Index\Controller;
//第二步：引入父类控制器
use Think\Controller;
//第三步：定义控制器并且继承父类
class EmptyController extends Controller {
	function index(){
		echo "空模块";
	}
}