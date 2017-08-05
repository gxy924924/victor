<html>
<?php
	//该案例演示对xml进行增删改

	//1.创建DOM Document 对象，表示文档
	$xmldoc=new DOMDocument();
	//2.指定加载哪个xml，解析哪个文件
	$xmldoc->load("classes.xml");
	//3.演示如何更新
	//（1）找到这个学生
	$stu1=$xmldoc->getElementsByTagName("学生")->item(0);
	//
	$stu1_age=$stu1->getElementsByTagName("年龄")->item(0);
	$stu1_age->nodeValue+=10;
	//更新文件
	//如果save到源文件，则相当于对源文件更新
	//如果save是新文件名，则是新建
	$xmldoc->save("classes.xml");
	echo "update ok";
?>
</html>