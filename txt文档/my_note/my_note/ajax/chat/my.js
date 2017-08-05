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

	function $(id){
		return document.getElementById(id);
	}

	function test(){
		alert("xxx");
	}