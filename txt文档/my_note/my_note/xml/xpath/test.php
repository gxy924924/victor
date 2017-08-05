<?php
//使用xpaht进行查询
$xmldoc=new DOMDocument();
$xmldoc->load("test.xml");

//转成DOMXPath
$domXpath=new DOMXpath($xmldoc);
//查询

$node_list=$domXpath->query("/aaa");
echo "/aaa-->".$node_list->length;
echo "</br>";
$node_list=$domXpath->query("//ccc");
echo "所有ccc-->".$node_list->length;
echo "</br>";
$node_list=$domXpath->query("/aaa/bbb");
echo "/aaa/bbb-->".$node_list->length;
echo "</br>";
$node_list=$domXpath->query("/aaa/bbb/ccc");
echo "/aaa/bbb/ccc-->".$node_list->length;
echo "</br>";
$node_list=$domXpath->query("/aaa/bbb/*");
echo "/aaa/bbb/*-->".$node_list->length;
echo "</br>";
$node_list=$domXpath->query("/*/bbb");
echo "/*/bbb-->".$node_list->length;
echo "</br>";
echo "</br>";
$node_list=$domXpath->query("//*");
for($i=0;$i<$node_list->length;$i++){
	echo $node_list->item($i)->tagName."</br>";
}
echo "</br>";
?>