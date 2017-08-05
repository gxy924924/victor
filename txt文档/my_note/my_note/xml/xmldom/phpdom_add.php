<html>
<?php
	//该案例演示对xml进行增删改

	//1.创建DOM Document 对象，表示文档
	$xmldoc=new DOMDocument();
	//2.指定加载哪个xml，解析哪个文件
	$xmldoc->load("classes.xml");
	//3.演示如何添加一个学生信息
	//（1）取出根节点
	$root=$xmldoc->getElementsByTagName("班级")->item(0);
	
	//（2）创建学生节点
	$stu_node=$xmldoc->createElement("学生");

	//添加属性节点
	//创建属性节点
	$stu_node->setAttribute("性别","男");
	
	//（3）创建名字节点
	$stu_node_name=$xmldoc->createElement("名字");
	$stu_node_name->nodeValue="韩顺平";//为什么我们可以使用nodeValue属性？？
	//把名字节点挂在到学生节点下
	$stu_node->appendChild($stu_node_name);
	//3.2创建年龄
	$stu_node_age=$xmldoc->createElement("年龄");
	$stu_node_age->nodeValue="80";
	$stu_node->appendChild($stu_node_age);
	//3.3创建介绍
	$stu_node_intro=$xmldoc->createElement("介绍");
	$stu_node_intro->nodeValue="学习不怎么刻苦";
	$stu_node->appendChild($stu_node_intro);

	//把学生节点挂载到根节点
	$root->appendChild($stu_node);
	//var_dump($root);
	//var_dump($stu_node);
	//重新保存回xml
	//如果save到源文件，则相当于对源文件更新
	//如果save是新文件名，则是新建
	$xmldoc->save("classes.xml");
	echo "add ok";
?>
</html>