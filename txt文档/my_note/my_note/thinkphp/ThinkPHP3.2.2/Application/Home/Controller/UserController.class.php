<?php
//第一步：定义命名空间
namespace Home\Controller;
//第二步：引入父类控制器
use Think\Controller;
//第三步：定义控制器并且继承父类
class UserController extends Controller {
	//测试方法 public private protected static
    public function test(){
       phpinfo();
    }
}