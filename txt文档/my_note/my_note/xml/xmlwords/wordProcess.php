<?php
	//接收用户提交的单词
	$type=$_POST['type'];
	echo $type."</br>";


	//判断用户想干啥
	if($type=="search"){
		$enword=$_POST['enword'];
		searchEnGetCh($enword);
	}else if($type=="add"){
	$enword=$_POST['enword'];
	$chword=$_POST['chword'];
	addWord($enword,$chword);
	}


	//获取值
	function getNodeVal($myNode,$tagName){
		return $myNode->getElementsByTagName($tagName)->item(0)->nodeValue;
	}
	//英文查询中文
	function searchEnGetCh($enword){
	//查询xml
		$xmldoc=new DOMDocument();
		$xmldoc->load("words.xml");
		$words=$xmldoc->getElementsByTagName("word");
		$isEnter=false;
		//遍历
		for($i=0;$i<$words->length;$i++){
			//依次取出单词
			$word=$words->item($i);
			$word_en=getNodeVal($word,"en");
			if($word_en==$enword){
				$isEnter=true;
				echo $word_en."：".getNodeVal($word,"ch");
			}
		}
		//没有查到
		if($isEnter==false){
			echo "未查到";
		}
	}

	//添加单词
	function addWord($enword,$chword){
		$xmldoc=new DOMDocument();
		$xmldoc->load("words.xml");
		$root=$xmldoc->getElementsByTagName("words")->item(0);
		//添加节点
		$new_word=$xmldoc->createElement("word");
		$new_enword=$xmldoc->createElement("en");
		$new_enword->nodeValue=$enword;
		$new_chword=$xmldoc->createElement("ch");
		$new_chword->nodeValue=$chword;
		//挂载
		$root->appendChild($new_word);
		$new_word->appendChild($new_enword);
		$new_word->appendChild($new_chword);
		//保存
		if($xmldoc->save("words.xml")){
			echo "保存成功";
		}
	}
?>