<html>
<?php
	//1.创建DOM Document 对象，代码就是xml文档
	$xmldoc=new DOMDocument();
	//2.加载xml （指定你要对哪个xml文件进行解析）
	$xmldoc->load("classes.xml");

	//3.希望获取第一个学生的名字
	$stus=$xmldoc->getElementsByTagName("学生");
	echo "共有".$stus->length."个学生";

	//选中第一个学生
	$stu1=$stus->item(0);

	//取出名字
	$stu_name=$stu1->getElementsByTagName("名字");

	//取出名字
	//echo $stu_name->item(0)->nodeValue;
	echo getNodeVal($stu1,"名字");
	echo getNodeVal($stu1,"年龄");
	echo getNodeVal($stu1,"介绍");

	function getNodeVal($myNode,$tagName){
		return $myNode->getElementsByTagName($tagName)->item(0)->nodeValue;
	}
?>
</html>