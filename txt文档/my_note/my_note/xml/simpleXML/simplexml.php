<?php
//装载一个xml文件
$lib=simplexml_load_file("books.xml");

//取出值,$books就是一个数组
$books=$lib->book;
echo count($books);
echo $book=$books[0];
//取出书名
echo $book->title;
echo "</br>";
//全部取出
for($i=0;$i<count($books);$i++){
	//取出属性值
	echo $books[$i]['house']."</br>";
	//
	echo "书名：".$books[$i]->title."|||作者：".$books[$i]->author."|||序号：".$books[$i]->code."|||价格：".$books[$i]->price."</br>";
}

//simpleXML也可以和XPath结合使用，功能强大

$titles=$lib->xpath("//title");

echo "</br>............simpleXml和XPath结合";
foreach($titles as $val){
	echo "</br>".$val;
}

?>
