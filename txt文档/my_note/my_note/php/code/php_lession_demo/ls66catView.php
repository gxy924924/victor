<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<script language="javascript">
<!--
function selType(val){
	window.alert("你点中了"+val);
	if(val=='jiSuan'){
		table1.style.display="block";
		table2.style.display="none";
	}else if(val=='area'){
		table1.style.display="none";
		table2.style.display="block";
	}
}
//--></script>
</head>
<body>
<h1>聪明的猫</h1>
<form action="ls66catWork.php" method="post">
<input type="radio" name="val" onclick="selType('jiSuan')">四则运算
<input type="radio" name="val" onclick="selType('area')">计算圆形面积

</form>
<!--计算-->
<form action="ls66catWork.php" method="post" style="display:none"  id="table1">
<input type="hidden" name="doing" value="jisuan">

第一个数：<input type="text" name="num1"></br>
第二个数：<input type="text" name="num2"></br>
<select name="oper">
<option value="+">+</option>
<option value="-">-</option>
<option value="*">*</option>
<option value="/">/</option>
</select></br>
<input type="submit" value="开始计算"/>
</form>
<form action="ls66catWork.php" method="post" style="display:none" id="table2">
<input type="hidden" name="doing" value="area">

半径：<input type="text" name="radius"></br>
<input type="submit" value="开始计算"/>
</form>
</body>
</html>
<?php

?>