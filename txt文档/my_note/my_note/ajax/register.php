<html>
<head>
<title>用户注册</title>
<meta http-equiv="conntent-type"content="text/html" charset="utf-8">
<script type="text/javascript">
	var myXmlHttpRequest="";
	//验证浏览器类型，并根据不同的情况创建ajax
	function getXmlHttpObject(){
		//不同的浏览器获取对象getXmlHttpObject方法不同
		if(window.ActiveXObject){
			//window.alert("ie");//ie浏览器
			xmlHttpRequest=new ActiveXObject("Microsoft.XMLHTTP");
		}else{
			//alert("hh");//火狐浏览器
			xmlHttpRequest=new xmlHttpRequest();
		}

		return xmlHttpRequest;
	}

		//验证用户名是否存在
		function checkName(){
			myXmlHttpRequest=getXmlHttpObject();
			//怎么判断创建ok
			if(myXmlHttpRequest){
				//alert("myXmlHttpRequest-success");
				//通过myXmlHttpRequest对象发送请求到服务器的某个页面
				//第一个参数表示请求的方式，"get"/"post"
				//第二个参数指定url，对哪个页面发出ajax请求（本质任然是http请求）
				//第三个参数表示 --true->使用异步机制，如果false表示不使用异步
/*-------------------------------get------------------------------------
				var url="/ajax/registerProcess.php?username="+$("username").value;
				//alert(url);
				//打开请求
				myXmlHttpRequest.open("get",url,true);
				//指定回调函数，chuli是函数名
				//函数变化就调用chuli
				myXmlHttpRequest.onreadystatechange=chuli;

				//真的发送请求,如果是get请求，则填 null即可
				//如果是post请求，则填入实际数据
				myXmlHttpRequest.send(null);
--------------------------------下面为post--------------------------*/
				var url="/ajax/registerProcess.php"
				var data="username="+$("username").value;
				myXmlHttpRequest.open("post",url,true);
				//还有一句话，必须
				myXmlHttpRequest.setRequestHeader("content-Type","application/x-www-form-urlencoded");
				myXmlHttpRequest.onreadystatechange=chuli;

				//真的发送请求,如果是get请求，则填 null即可
				//如果是post请求，则填入实际数据
				myXmlHttpRequest.send(data);

			}else{
				alert("失败");
			}
		}

		//回调函数
		function chuli(){
			//alert("处理函数被调回"+myXmlHttpRequest.readyState);
			//要取出registerPro。php返回
			if(myXmlHttpRequest.readyState==4){
				//-----------------简单数据-----------------
				//取出值
				//alert("服务器返回的是："+myXmlHttpRequest.responseText);
				//usertell.innerText=myXmlHttpRequest.responseText;
				//alert(myXmlHttpRequest.responseXML);
				//------------------------xml数据---------------------------
				/*
				//获取mes节点
				var mes=myXmlHttpRequest.responseXML.getElementsByTagName("mes");
				//取出mes节点值
				//alert(mes.length);
				var mes_val=mes[0].childNodes[0].nodeValue;
				//alert(mes_val);
				usertell.innerText=mes_val;*/
				//------------------------json数据---------------------------
				var mes=myXmlHttpRequest.responseText;
				//使用eval函数将mes字串转换成对应的对象
				var mes_obj=eval("("+mes+")");//这是固定写法
				//取出json数据的res的格式
				//alert(mes_obj.res);
				usertell.innerText=mes_obj.res;

			
			}
		}

		//这里写个函数
		function $(id){
			return document.getElementById(id);
		}
	
</script>
</head>
<body>
<h1>原版</h1>
<form action="registerProcess.php" method="get">
	用户名：<input type="text" name="username" id="username" onkeyup="checkName()">
	<font color=red id="usertell"></font>
	</br>
	密 &nbsp&nbsp码：<input type="text" name="password" id="password"></br>
	邮 &nbsp&nbsp件：<input type="text" name="email" id="email"></br>
	<input type="submit" value="提交">
</form>
<h1>ajax版</h1>
<form action="registerProcess.php" method="get">
	用户名：<input type="text" name="username2" id="username2"></br>
	密 &nbsp&nbsp码：<input type="text" name="username1" id="password2"></br>
	邮 &nbsp&nbsp件：<input type="text" name="username1" id="email2"></br>
	<input type="submit" value="提交">
</form>

<input type="button" onclick="checkName()" value="test">
<body>
</html>