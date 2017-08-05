<!--界面-->
<html>
<head>
<meta equiv-type="content-type" content="text/html;charset=utf-8">
<script language="javascript">

	function check(){
		//js的内容
		var num1val=document.getElementById("num1").value;
		var num2val=document.getElementById("num2").value;
		//window.alert(num1val+" "+num2val);
		if(isNaN(num1val)||isNaN(num2val)){
			window.alert("num1和num2必须是数");
			//放弃提交
			return false;
		}
	}

</script>

</head>
<body>
<h1>我的计算器</h1>
<form action="ls78calcu.php" method="post" onsubmit="return check()">
num1<input type="text" id="num1" name="num1"></br>
num2<input type="text" id="num2" name="num2"></br>
oper<select name="oper">
<option  value="+">+</option>
<option  value="-">-</option>
<option  value="*">*</option>
<option  value="/">/</option>
</select>
<input type="submit" value="计算">
</form>
</body>
</html>