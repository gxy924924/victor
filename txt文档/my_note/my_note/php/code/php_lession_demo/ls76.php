<?php
//实用程序模拟现实情况
//定义规范（方法/属性）
interface iUsb{
public function start();
public function stop();
}
//便携手机类，让他去实现接口
//1.当一个类实现了某个接口，则要求该类必须实现这个借口的所有方法
class Camera implements iUsb{
	public function start(){
		echo "相机开始工作。。。";
	}
	public function stop(){
		echo "相机停止工作。。。";
	}
}

class Phone implements iUsb{
	public function start(){
		echo "手机开始工作。。。";
	}
	public function stop(){
		echo "手机停止工作。。。";
	}
}

//如何使用
//相机对象
$camera1=new Camera();
$camera1->start();
$camera1->stop();
$phone1=new Camera();
$phone1->start();
$phone1->stop();

?>