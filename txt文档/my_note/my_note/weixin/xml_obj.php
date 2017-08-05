<?php

$xml="<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName>
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[text]]></MsgType>
 <Content><![CDATA[this is a test]]></Content>
 <MsgId>1234567890123456</MsgId>
 </xml>";

libxml_disable_entity_loader(true);
$postObj=simplexml_load_string($xml,'SimpleXMLElement',LIBXML_NOCDATA);
//转换为类