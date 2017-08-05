<html>
<head>
<meta charset="utf-8">
<title></title>
<script src="./Public/jquery-1.4.2/jquery.js">
</script>
<style>
body{
	margin-left:11px;
	margin-top:10px;
	border:1px solid #ccc;
}
#div_top{
	background-color:#ccc;
	background-image:url("./Public/image/bg.png");
	border:1px solid #ccc
	margin:0;
	width:196px;

}
#img1{
	margin-left: 12px;
}
#font_title{
	color:#6B9DBD;
	font-size:13;
	font-style:normal;
	text-decoration:none
}
#td1{
	width:50px;
	height:50px;
}
#table_top{
	width:196px;
}

#table1{
	width:196px;
	border:1px solid #ccc
	margin:0;
}
#font1{
	font-size:15;

}
#font1 a{
	text-decoration:none;
	color:black;
}
#div_t1{
	height:28px;
	background-image:url("./Public/image/t1.png");
	padding-left:10px;
	padding-top:8px;
}
.div_lv2-1,.div_lv2{
	height:28px;
	padding-left:25px;
	padding-bottom:0;
	
}
.div_lv2-1{
	padding-top:6px;
}
.div_lv2{
	padding-top:0px;
}
.clicktab{
	cursor:pointer;
}
</style>
</head>
<body>
	<!--登录状态-->
	<div id="div_top" >
		<table id="table_top"  cellpadding=0 cellspacing=0>
			<tr>
				<td rowspan=2 id="td1"><img src="./Public/image/wel.png" id="img1"></img></td>
				<td> <font id="font_title">您好</font></td>
			</tr>

		</table>
	</div>
	<!--导航边栏-->
	<table id="table1"  cellpadding=0 cellspacing=0>
		<tr class="clicktab" id="show1">
			<td>
				<div id="div_t1">
					<font id="font1">
						<a href="<?php  echo U_PATH; ?>?c=File&v=upload_file" target="mainFrame">▶上传文件</a>
					</font>
				</div>
			</td>
		</tr>

		<tr class="clicktab" id="show2">
			<td>
				<div id="div_t1">
					<font id="font1">
						<a href="<?php  echo U_PATH; ?>?c=File&v=show_file" target="mainFrame">▶查看文件</a>
					</font>
				</div>
			</td>
		</tr>

		<tr class="clicktab" id="show3">
			<td><div id="div_t1"><font id="font1">▶...</font></div></td>
		</tr>

		<tr class="clicktab" id="show4">
			<td><div id="div_t1"><font id="font1">▶...</font></div></td>
		</tr>

		<tr class="clicktab" id="show5">
			<td><div id="div_t1"><font id="font1">▶...</font></div></td>
		</tr>

		<tr class="clicktab" id="show6"> 
			<td><div id="div_t1"><font id="font1">▶...</font></div></td>
		</tr>

	</table>
</body>
<script type="text/javascript">

</script>
</html>