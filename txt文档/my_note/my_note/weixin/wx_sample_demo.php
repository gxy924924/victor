<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
if($_GET["echostr"]){
	$wechatObj->valid();
}else{
	$wechatObj->responseMsg();
}


class wechatCallbackapiTest{
    public $postObj;
    public $msg;
	//验证是否token相符，相符则返回echostr
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }
	
	//回复
    public function responseMsg()
    {
		//获取发送的数据，根据不同的情况作出相应的反应
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//解析 post data
			/* 由于微信有自己的检查系统，故不存在空消息（无论空格、回车都无效） */
			libxml_disable_entity_loader(true);
			$this->postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);//解析xml
			$this->msg["fromUsername"] = $this->postObj->FromUserName;		//从微信端获取FromUserName（发送端-网站-用户名）
			$this->msg["toUsername"] = $this->postObj->ToUserName;			//从微信端获取ToUserName（接收端-微信-用户名）
			$this->msg["keyword"] = trim($this->postObj->Content);			//从微信端获取Content（消息）

			$this->msg["time"] = time();								//从本地获取时间戳	
			
			//$getmsgType = $postObj->MsgType;				//从微信端获取对方的操作种类
        	$this->msg["getmsgType"] = $this->postObj->MsgType;

			$this->getmsgType_switch();
			
			$this->msgType_switch();
				
				
			
    }
		
	//验证
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	public function getmsgType_switch(){
		switch($this->msg["getmsgType"]){
			case "event":
				$e=$this->postObj->Event;
				switch($e){
					case "subscribe":
						$this->msg["msgType"] = "text";				//消息格式
						$this->msg["contentStr"] = "欢迎你，这里是vic的微信测试号";
						break;
				}
				break;
			case "image":
				$this->msg["msgType"] = "text";
				$this->msg["contentStr"] = "你发了个图片。。";
				break;
			case "voice":
				$this->msg["msgType"] = "text";
				$this->msg["contentStr"] = "你说了句话。。但是我是计算机听不懂啊。。";
				break;
			case "CLICK":
				$key=$this->postObj->Eventkey;
				$this->msg["keyword"]="news";
				$this->text_switch();
				switch($key){	//根据菜单单击事件的key值返回相应。。
					case "news":
						$this->msg["keyword"]="news";
						$this->text_switch();
						break;
				}
			break;	 
			case "text":
				$this->text_switch();
				break;
		}
	}
	public function text_switch(){
		//如果收到内容。。。
		switch($this->msg["keyword"]){
			case "time":
				$this->msg["msgType"] = "text";					//消息格式
				$this->msg["contentStr"]=time();					//发送的信息
				break;
			case "name":
				$this->msg["msgType"] = "text";
				$this->msg["contentStr"]="from=".$this->msg["fromUsername"]."\r\n to=".$this->msg["toUsername"]."\r\n getCont=".$this->msg["keyword"];
				break;
			case "photo":
				$this->msg["msgType"]="image";
				$this->msg["imageStr"]="jSlX7z4ROGCvejjygprCBMYRYcVP4-qK1uNvbk8WWmqwx1VryJxGAuNOH40S_Fww";
				break;
			case "test":
				$this->msg["msgType"]="image";
				$this->msg["imageStr"]="pxHgyf8oi708pH7sn-xuneDHNhSkViIf1kDisOo0kqQC5Qcc3nob8rkQ6_0K_h8M";
				break;
			case "news":
				$this->msg["msgType"]="news";
				$this->msg["news"]=array(
					array(
						"title"=>"我有一个梦想",
						"description"=>"我有一个梦想，希望有一天，自己能够成为一个真正自由的人，浪迹天涯，周游世界。。。",
						"picurl"=>"http://1.gweixin.applinzi.com/2d_code.jpg",
						"url"=>"http://1.gweixin.applinzi.com/",
					),
				);
				$this->msg["articleCount"]=count($this->msg["news"]);					//要写几个图文
				break;
			default:
				$this->msg["msgType"] = "text";
				$this->msg["contentStr"] = "帮助：随意输入可获取帮助\r\n
								输入time:获取时间戳\r\n
								输入name:获取双方的名字\r\n
								输入photo:获取图片（我的订阅号的二维码）\r\n
								输入test:获取图片（我的测试号的二维码）\r\n
								输入news:获取图文消息\r\n";
				break;

		}
	}

	function msgType_switch(){
		switch($this->msg["msgType"]){
			case "join":			//join方式默认返回文字
			case "text":
				$textTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[text]]></MsgType>
				<Content><![CDATA[%s]]></Content>
				<FuncFlag>0</FuncFlag>
				</xml>";						//文本xml结构
				$resultStr = sprintf($textTpl, $this->msg["fromUsername"], $this->msg["toUsername"], $this->msg["time"], $this->msg["contentStr"]);
				break;
			case "image":
				$phtotTpl=" <xml>
				 <ToUserName><![CDATA[%s]]></ToUserName>
				 <FromUserName><![CDATA[%s]]></FromUserName>
				 <CreateTime>%s</CreateTime>
				 <MsgType><![CDATA[image]]></MsgType>
				 <Image>
				 <MediaId><![CDATA[%s]]></MediaId>
				 </Image>
				 </xml>";						//图片xml结构
				$resultStr = sprintf($phtotTpl, $this->msg["fromUsername"], $this->msg["toUsername"], $this->msg["time"], $this->msg["imageStr"]);
				break;
			case "news":
				$newsTpl="<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>%s</ArticleCount>
							<Articles> ";						//图文xml结构
				$newsItem="<item>
							<Title><![CDATA[%s]]></Title>
							<Description><![CDATA[%s]]></Description>
							<PicUrl><![CDATA[%s]]></PicUrl>
							<Url><![CDATA[%s]]></Url>
							</item>";						//消息模板
					$end=	"</Articles>
							</xml> ";						//结尾
				$resultStr = sprintf($newsTpl, $this->msg["fromUsername"], $this->msg["toUsername"], $this->msg["time"], $this->msg["articleCount"]);
															//开头信息替换
				for($i=0;$i<$this->msg["articleCount"];$i++){			//将编入数组的信息进行替换并加入返回信息
					$resultStr.= sprintf($newsItem, $this->msg["news"][$i]["title"], $this->msg["news"][$i]["description"], $this->msg["news"][$i]["picurl"], $this->msg["news"][$i]["url"]);
					}
				$resultStr.= $end;							//加入结尾
				break;
		}
		echo $resultStr;
	}
}

?>