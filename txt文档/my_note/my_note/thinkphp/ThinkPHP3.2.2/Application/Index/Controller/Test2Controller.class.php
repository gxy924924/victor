<?php
//第一步：定义命名空间
namespace Index\Controller;
//第二步：引入父类控制器
use Think\Controller;
//第三步：定义控制器并且继承父类
class Test2Controller extends Controller {
	function index(){
		$check=true;
		$user=D('myuser');
		$row=$user->relation($check)->select();
		echo "<pre>";
		print_r($row);
		echo "</pre>";
	}
	function test(){
		$this->display();
	}
	function test_ip(){
		//import("ORG.Net.IpLocation");			//说明import注入失败2017/2/12
		//import('ORG.Net.IpLocation');
		$ip=new IpLocation('UTFWry.dat'); 
		echo $ip->getLocation('127.0.0.1');
	}
	function test_ip2(){
		$ip = get_client_ip();
		echo $ip."</br>";

	}
	function test_ip3(){
		$Ip = new \Org\Net\IpLocation(); // 实例化类 参数表示IP地址库文件，可填入dat文件名称，默认是UTFwry.dat，如果填入其它文件，将进行替换
										//说明：如果UTFwry.dat文件不存在，此功能将不能使用
		echo $ip1 = get_client_ip()."</br>";
		$area = $Ip->getlocation($ip1); // 获取某个IP地址所在的位置
		//echo __FILE__."</br>aaa</br>";
		echo "<pre>";
		print_r($area);
		echo "</pre>";
	}
	function test_ips(){
		echo "<pre>";
		print_r($_SERVER);
		echo "</pre>";
	}
	function test_foreach(){
		$user=M('user');
		$this->rows=$user->order('id')->select();//此处this->rows代替了assign
		$this->week=3;
		$this->state=1;
		$this->display();

	}
	function test_extends(){
		$this->display();
	}
	function test_cache(){
		$this->test=1112;
		$this->display();
	}
	function test_cache2(){
		if(!S('rows')){
			$user=M('user');
			$rows=$user->select();
			S('rows',$rows);
		}
		$this->rows=S('rows');
		$this->display();
	}
}