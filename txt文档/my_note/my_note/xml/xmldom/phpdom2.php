<html>
<?php
	//该案例演示对xml进行增删改（删除一个学生信息）

	//1.创建DOM Document 对象，表示文档
	$xmldoc=new DOMDocument();
	//2.指定加载哪个xml，解析哪个文件
	$xmldoc->load("classes.xml");
	//3.演示如何删除一个学生信息
	//（1）取出根节点
	$root=$xmldoc->getElementsByTagName("班级")->item(0);
	//删除第三个学生
	//（2）删除学生节点
	$stu1=$xmldoc->getElementsByTagName("学生")->item(2);
	//$root->removeChild($stu1);
	//这里又更灵活的方法(通过函数直接到父节点)
	$stu1->parentNode->removeChild($stu1);

	//更新文件
	//如果save到源文件，则相当于对源文件更新
	//如果save是新文件名，则是新建
	$xmldoc->save("classes.xml");
	echo "delete ok";
?>
</html>