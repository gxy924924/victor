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

	function updateGoldPrice(){
		myXmlHttpRequest=getXmlHttpObject();
		
		
		if(myXmlHttpRequest){
			var url="/ajax/goldPriceProcess.php";
			var data="city[]=dj&city[]=tw&city[]=ld";//3个城市

			myXmlHttpRequest.open("post",url,true);//异步

			myXmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

			myXmlHttpRequest.onreadystatechange=chuli;
			myXmlHttpRequest.send(data);
		}
	}

	function chuli(){
			if(myXmlHttpRequest.readyState==4){
				if(myXmlHttpRequest.Status==200){
					//接收json
					var res=myXmlHttpRequest.responseText;

					//alert(res);
					var res_objects=eval("("+res+")");
					$("ld").innerText=res_objects[0].price;
					$("tw").innerText=res_objects[1].price;
					$("dj").innerText=res_objects[2].price;
					$("ldzd").innerText=zhangdie(res_objects[0].price);
					$("twzd").innerText=zhangdie(res_objects[1].price);
					$("djzd").innerText=zhangdie(res_objects[2].price);
				}
			}
		}
	
	function zhangdie(price){
		var zdnum=price-1000;
		if(zdnum>=0){
			return zdnum="涨"+zdnum;
		}else{
			return zdnum="跌"+(-zdnum);
		}
	}

	function $(id){
		return document.getElementById(id);
	}
	
	//使用定时器，每隔5秒
	window.setInterval("updateGoldPrice()",5000);
</script>
</head>
<body>
<center>
<h1>每隔秒更新数据（以1000为基数计算涨跌）</h1>
	<table border=0 class="abc">
		<tr><td>市场</td><td>最新价格$</td><td>涨跌</td></tr>
		<tr><td>伦敦</td><td id="ld">788.7</td><td id="ldzd">跌211.3</td></tr>
		<tr><td>台湾</td><td id="tw">854.0</td><td id="twzd">跌146.0</td></tr>
		<tr><td>东京</td><td id="dj">1791.3</td><td id="djzd">涨791.3</td></tr>
	</table>
</center>
</body>
</html>