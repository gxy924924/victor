<html>
<?php
	//解析一个文件的步骤
	//1.创建DOM Document 对象，表示文档
	$xmldoc=new DOMDocument();
	//2.指定加载哪个xml，解析哪个文件
	$xmldoc->load("classes.xml");
	//3.获取你关心的节点
	//把所有的学生获取（DOMDocument）
	$stus=$xmldoc->getElementsByTagName("学生");
	//4.遍历
	for($i=0;$i<$stus->length;$i++){
		//
		$stu=$stus->item($i);
		//
		echo "名字:".getNodeVal($stu,"名字")." &nbsp";
		echo "年龄:".getNodeVal($stu,"年龄")." &nbsp";
		echo "介绍:".getNodeVal($stu,"介绍")." &nbsp";
		echo "</br>";
	}

	function getNodeVal(&$myNode,$tagName){
		return $myNode->getElementsByTagName($tagName)->item(0)->nodeValue;
	}
?>
</html>