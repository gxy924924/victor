<html>
<head>
<?php
	$username=$_GET['username'];
	session_start();
	//取出session保存的登录人的名字
	$loginUser=$_SESSION['loginuser'];
?>
<meta http-equiv="content-type" content="text/html"charset="utf-8">
<script type="text/javascript" src="my.js"></script>
<script type="text/javascript">
	window.resizeTo(700,600);
	
	var myXmlHttpRequest=""
	function sendMessage(){
		//创建一个xmlHttpRequest对象（调用已有的my.js）
		myXmlHttpRequest=getXmlHttpObject();
		//alert(myXmlHttpRequest);
		if(myXmlHttpRequest){
			var url="/ajax/chat/sendMessageController.php";
			//这里有新的知识，js中如何嵌入php
			if($('con').value){
				var data="con="+$('con').value+"&getter=<?php echo $username; ?>&sender=<?php echo $loginUser; ?>";
			}else{
				return false;
			}
			myXmlHttpRequest.open("post",url,true);
			myXmlHttpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			//alert('a');
			myXmlHttpRequest.onreadystatechange=chuli_send;
			//alert('b');
			myXmlHttpRequest.send(data);

			$("myText").innerText+="\r\n"+new Date().toLocaleString()+"你："+$('con').value;
		}
	}
	
	function chuli_send(){
		//alert(myXmlHttpRequest.readyState);
		if(myXmlHttpRequest.readyState==4){
			//alert("readyState=4");
			if(myXmlHttpRequest.Status==200){
				//alert("status=200");
				if(myXmlHttpRequest.responseText){
					alert(myXmlHttpRequest.responseText);
				}
			}
		}
	}

	function getMessage(){
		//创建一个xmlHttpRequest对象（调用已有的my.js）
		myXmlHttpRequest=getXmlHttpObject();
		//alert(myXmlHttpRequest);
		if(myXmlHttpRequest){
			var url="getMessageController.php";
			//这里有新的知识，js中如何嵌入php
			var data="con="+$('con').value+"&getter=<?php echo $loginUser; ?>&sender=<?php echo $username; ?>";
			myXmlHttpRequest.open("post",url,true);
			myXmlHttpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			//alert('a');
			myXmlHttpRequest.onreadystatechange=chuli_get;
			//alert('b');
			myXmlHttpRequest.send(data);
		}
	}

	function chuli_get(){
		//alert(myXmlHttpRequest.readyState);
		if(myXmlHttpRequest.readyState==4){
			//alert("readyState=4");
			if(myXmlHttpRequest.Status==200){
				//alert("status=200");
				if(myXmlHttpRequest.responseXML){
					var mesRes=myXmlHttpRequest.responseXML;
					//第一步取出con和sendTime
					var cons=mesRes.getElementsByTagName("con");
					var sendTime=mesRes.getElementsByTagName("sendTime");
					
					if(cons.length!=0){
						for(var i=0;i<cons.length;i++){
							
							$("myText").innerText=$("myText").innerText+"\r\n"+sendTime[i].childNodes[0].nodeValue+"-》<?php echo $username; ?>说："+cons[i].childNodes[0].nodeValue;
						}
					}
					//$("myText").innerText=cons.length;
				}
			}
		}
	}
	setInterval("getMessage()",5000);
</script>
</head>

<body>
<center>
<h1>聊天室(您(<?php echo $loginUser;?>)正在和<font color="red"><?php echo $username; ?></font>聊天)</h1>
<textarea cols="70" rows="20" id="myText"></textarea></br>
发送内容：<input type="text" id="con">
<input type="button" value="发送" onclick="sendMessage()">
<input type="button" value="get" onclick="getMessage()">
</form>
</center>
</body>
</html>