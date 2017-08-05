<?php
class checkcode{
	public $checkcode=""; //验证码
	//画布数据
	public $im;			//图像
	public $red;		//红色
	public $line=5;		//干扰线数量
	public $color;		//自定义颜色
	//创建验证码
	function getcheckcode(){
		for($i=0;$i<4;$i++){
			$this->checkcode.=dechex(rand(1,15));//转化为16进制
		}
		$_SESSION['checkcode']=$this->checkcode;
	}

	//
	function getimg(){
		$this->getcheckcode();
		$this->im=imagecreatetruecolor(70,30);	//创建一个画布(确定大小)
		$this->red=imagecolorallocate($this->im,254,0,0);//创建颜色
		for($i=0;$i<$this->line;$i++){
			$this->color=imagecolorallocate($this->im,rand(0,254),rand(0,254),rand(0,254));//创建颜色
			imageline($this->im,rand(0,80),rand(0,30),rand(0,80),rand(0,50),$this->color);//画出干扰线
		}
		imagestring($this->im,rand(2,5),rand(0,40),rand(0,15),$this->checkcode,$this->red);//加入验证码
		//输出图像
		header("content-type:image/png");
		imagepng($this->im);
		imagedestory($this->im);
	}
}

?>