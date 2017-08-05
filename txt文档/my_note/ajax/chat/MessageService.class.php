<?php
require_once 'sqlHelper.class.php';

class MessageService{
	function addMessage($sender,$getter,$con){
		//组织一个sql
		$sql="insert into message(sender,getter,content,sendTime)values('$sender','$getter','$con',now())";

		//file_put_contents("mylog.txt",'$sql='.$sql."\r\n",FILE_APPEND);
		//创建sqlHelper对象
		$sqlHelper=new sqlHelper();
		return $sqlHelper->execute_dml($sql); 

	}
	
	//获取数据，并把数据组装好返回客户端  getter=$getter and 
	function getMessage($sender,$getter){
		$sql="select * from message where getter='$getter' and sender='$sender' and isGet=0";
		$sqlupdate="update message set isGet=1 where getter='$getter' and sender='$sender'";
		//file_put_contents("mylog.txt",'$sql='.$sql."\r\n",FILE_APPEND);
		$sqlHelper=new sqlHelper();
		$arr=$sqlHelper->execute_dql2($sql); 
		$sqlHelper->execute_dml($sqlupdate); 
		//file_put_contents("mylog.txt",'$arr='.$arr[0]["id"]."\r\n",FILE_APPEND);
		//返回，我们定义一下返回给客户端的信息格式
		//xml->json
		//$messageInfo="<mess><mesid>1</mesid><sender>张三</sender><getter>松江</getter><con>hello</con><sendTime>2017-1-19</sendTime></mess>"
		//难点，如何拼接这个xml
		$messageInfo="<mess>";
		for($i=0;$i<count($arr);$i++){
			$row=$arr[$i];
			$messageInfo.="<mesid>{$row['id']}</mesid><sender>{$row['sender']}</sender><getter>{$row['getter']}</getter><con>{$row['content']}</con><sendTime>{$row['sendTime']}</sendTime>";
		}
		$messageInfo.="</mess>";
		return $messageInfo;
		//file_put_contents("mylog.txt",'$messageInfo='.$messageInfo."\r\n",FILE_APPEND);
	}
}