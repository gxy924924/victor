<html>
<head>
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<script type="text/javascript">
//创建ajax引擎
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

	function getCities(){
		myXmlHttpRequest=getXmlHttpObject();

		if(myXmlHttpRequest){
			var url="/ajax/showCitiesProcess.php";
			var data="province="+$('sheng').value;

			myXmlHttpRequest.open("post",url,true);//异步

			myXmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

			myXmlHttpRequest.onreadystatechange=chuli;
			myXmlHttpRequest.send(data);
		}
	}

	function chuli(){
		//alert("aaa");
			if(myXmlHttpRequest.readyState==4){
				//alert(myXmlHttpRequest.Status);
				if(myXmlHttpRequest.Status==200){
					//var mes=myXmlHttpRequest.responseText;
					//alert(myXmlHttpRequest.responseText);
					$("city").length=0;
					var myOption=document.createElement("option");
					myOption.value="city";
					myOption.innerText="-市-";
					$('city').appendChild(myOption);

					var cities=myXmlHttpRequest.responseXML.getElementsByTagName("city");
					for(var i=0;i<cities.length;i++){
						var city_name=cities[i].childNodes[0].nodeValue;
						//alert(city_name);
						//创建新的元素option
						var myOption=document.createElement("option");
						myOption.value=city_name;
						myOption.innerText=city_name;
						$('city').appendChild(myOption);
					}
				}
			}
		}


	function $(id){
		return document.getElementById(id);
	}


</script>
</head>
<body>
<select id="sheng" onchange="getCities()">
<option>-省-</option>
<option value="shanxi">山西</option>
<option value="jiangsu">江苏</option>
</select>
<select id="city">
<option value="city">-市-</option>
</select>
<select id="xian">
<option>-县-</option>
<option></option>
</select>
</body>
</html>