<?php
//php绘图技术
//echo "<table>";
	class image1{
	//-创建画布(默认背景是黑色)
	public $im;

	//-绘制需要的各种（）图形圆形，直线，矩形。。。）
	//创建一个颜色
	public $red;
	}


	function demo1(){
	// 画一个椭圆(背景，圆心（x，y）（宽度，高度） )
	imageellipse($im,20,20,20,20,$red);
	//— 画一条线段（中从 x,y 到x2,y2画一条线段。 ）
	imageline($im,0,0,20,20,$red);
	//画一个矩形（左上角-》右下角）
	imagerectangle($im,0,0,20,20,$red);
	//实心矩形
	imagefilledrectangle($im,20,20,40,40,$red);
	//弧线（在椭圆基础上截取一段（从右边顺时针））
	imagearc($im,40,40,60,60,0,150,$red);
	//扇形
	imagefilledarc($im,40,40,60,60,0,20,$red,IMG_ARC_PIE);
	}

	//
	function imageOutput($im){
		//-输出图像到网页，也可以另存
		header("content-type:image/png");
		imagepng($im);
		//-销毁该图片（释放内存）
		imagedestory($im);
	}
	function demo2(){
		//拷贝图片到画布
		//1.加载原图片
		$srcImage=imagecreatefrompng("demo1.png");
		//这里我们可以使用一个getimagesize()函数来获取信息
		//array(6) { [0]=> int(610) [1]=> int(716) [2]=> int(3) [3]=> string(24) "width="610" height="716"" ["bits"]=> int(8) ["mime"]=> string(9) "image/png" }
		$srcImageInfo=getimagesize("demo1.png");
		//var_dump($srcImageInfo);
		//拷贝图片到目标画布
		imagecopy($im,$srcImage,10,30,20,20,100,100);
	}

	//
	function demo3($im,$red){
		//写字
		//imagestring只支持英文imagestring ( resource $image , int $font , int $x , int $y , string $s , int $col )

		//imagestring($im,5,0,0,"helloworld,年华",$red);
		//imagettftext(大小，角度（逆时针），基点位置（x,y）基点:文字左下角)
		imagettftext($im,20,30,20,160,$red,"C:\Windows\Fonts\simhei.ttf","helloworld,年华");
	}
$image=new image1();

$image->im=imagecreatetruecolor(400,300);

//-绘制需要的各种（）图形圆形，直线，矩形。。。）
//创建一个颜色
$image->red=imagecolorallocate($image->im,255,0,0);

demo3($image->im,$image->red);
//调用函数输出图像
imageOutput($image->im);

////-输出图像到网页，也可以另存
//header("content-type:image/png");
//imagepng($im);
////-销毁该图片（释放内存）
//imagedestory($im);
?>