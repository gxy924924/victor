<?php
//php绘图技术
	class image1{
		//-创建画布(默认背景是黑色)
		public $im;
		//-绘制需要的各种（）图形圆形，直线，矩形。。。）
		//创建一个颜色
		public $red;
		public $darkred;
		public $blue;
		public $darkblue;
		public $gray;
		public $darkgray;
		public $white;
		}

		function imageOutput($im){
			//-输出图像到网页，也可以另存
			header("content-type:image/png");
			imagepng($im);
			//-销毁该图片（释放内存）
			imagedestory($im);
	}

	$checkCode="";
	for($i=0;$i<4;$i++){
		$checkCode.=dechex(rand(1,15));
}

//存入到
session_start();
$_SESSION['checkcode']=$checkCode;

$image=new image1();
$image->im=imagecreatetruecolor(80,30);

//-绘制
//创建一个颜色
$image->red=imagecolorallocate($image->im,254,0,0);

//画出干扰线
for($i=0;$i<8;$i++){
	
	imageline($image->im,rand(0,80),rand(0,30),rand(0,80),rand(0,30),imagecolorallocate($image->im,rand(0,255),rand(0,255),rand(0,255)));
}


imagestring($image->im,rand(1,5),rand(0,45),rand(0,15),$checkCode,$image->red);

//$image->darkred=imagecolorallocate($image->im,144,0,0);

//$image->blue=imagecolorallocate($image->im,0,0,128);
//$image->darkblue=imagecolorallocate($image->im,0,0,80);

//$image->gray=imagecolorallocate($image->im,192,192,192);
//$image->darkgray=imagecolorallocate($image->im,144,144,144);

//调用函数输出图像
imageOutput($image->im);

////-输出图像到网页，也可以另存
//header("content-type:image/png");
//imagepng($im);
////-销毁该图片（释放内存）
//imagedestory($im);
?>