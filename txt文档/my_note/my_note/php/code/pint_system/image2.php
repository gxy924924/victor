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

$image=new image1();
$image->im=imagecreatetruecolor(600,400);
$image->white=imagecolorallocate($image->im,255,255,255);
imagefill($image->im,0,0,$image->white);

//-绘制需要的各种（）图形圆形，直线，矩形。。。）
//创建一个颜色
$image->red=imagecolorallocate($image->im,254,0,0);
$image->darkred=imagecolorallocate($image->im,144,0,0);

$image->blue=imagecolorallocate($image->im,0,0,128);
$image->darkblue=imagecolorallocate($image->im,0,0,80);

$image->gray=imagecolorallocate($image->im,192,192,192);
$image->darkgray=imagecolorallocate($image->im,144,144,144);
//imagefilledarc($image->im,80,60,90,60,0,360,$image->red1,IMG_ARC_PIE);
//imagefilledrectangle($image->im,36,50,124,60,$image->red1);
$x=300;
$y=180;
$w=500;
$h=300;
for($i=200;$i>$y;$i--){
imagefilledarc($image->im,$x,$i,$w,$h,0,35,$image->darkred,IMG_ARC_PIE);
imagefilledarc($image->im,$x,$i,$w,$h,35,76,$image->darkblue,IMG_ARC_PIE);
imagefilledarc($image->im,$x,$i,$w,$h,76,360,$image->darkgray,IMG_ARC_PIE);
}
imagefilledarc($image->im,$x,$y,$w,$h,0,35,$image->red,IMG_ARC_PIE);
imagefilledarc($image->im,$x,$y,$w,$h,35,76,$image->blue,IMG_ARC_PIE);
imagefilledarc($image->im,$x,$y,$w,$h,76,360,$image->gray,IMG_ARC_PIE);
//调用函数输出图像
imageOutput($image->im);

////-输出图像到网页，也可以另存
//header("content-type:image/png");
//imagepng($im);
////-销毁该图片（释放内存）
//imagedestory($im);
?>