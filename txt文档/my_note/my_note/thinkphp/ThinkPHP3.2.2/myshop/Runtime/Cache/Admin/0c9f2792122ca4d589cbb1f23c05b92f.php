<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta charset="utf-8">
<title></title>
<script src="/ThinkPHP3.2.2/Public/jquery-1.4.2/jquery.js">
</script>
<style>
body{
	margin-left:11px;
	margin-top:10px;
	border:1px solid #ccc;
}
#div_top{
	background-color:#ccc;
	background-image:url("/ThinkPHP3.2.2/Public/image/bg.png");
	border:1px solid #ccc
	margin:0;
	width:200px;

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
	width:198px;
}

#table1{
	width:200;
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
	background-image:url("/ThinkPHP3.2.2/Public/image/t1.png");
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
#div_t1-1,#div_t1-2,#div_t1-3,#div_t1-4,#div_t1-5,#div_t1-6{
	display:none;
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
				<td rowspan=2 id="td1"><img src="/ThinkPHP3.2.2/Public/image/wel.png" id="img1"></img></td>
				<td> <font id="font_title">您好<?php echo ($_SESSION['username']); ?></font></td>
			</tr>
			<tr>
				<td>
					<font id="font_title">[<a id="font_title" href="">退出</a>]</font>
				</td>
			</tr>
		</table>
	</div>
	<!--导航边栏-->
	<table id="table1"  cellpadding=0 cellspacing=0>
		<tr class="clicktab" value="1">
			<td><div id="div_t1"><font id="font1">▶用户管理</font></div></td>
		</tr>
		<tr id="div_t1-1">
			<td>
			<div class="div_lv2-1"><font id="font1"><a href="<?php echo U('User/index');?>" target="mainFrame">查看用户</a></font></div>
			<div class="div_lv2"><font id="font1"><a href="" target="mainFrame">添加用户</a></font></div>
			</td>
		</tr>
		
		<tr class="clicktab" value="2">
			<td><div id="div_t1"><font id="font1">▶分类管理</font></div></td>
		</tr>
		<tr id="div_t1-2">
			<td>
			<div class="div_lv2-1"><font id="font1"><a href="" target="mainFrame">查看分类</a></font></div>
			<div class="div_lv2"><font id="font1"><a href="" target="mainFrame">添加分类</a></font></div>
			</td>
		</tr>

		<tr class="clicktab" value="3">
			<td><div id="div_t1"><font id="font1">▶品牌管理</font></div></td>
		</tr>
		<tr id="div_t1-3">
			<td>
			<div class="div_lv2-1"><font id="font1"><a href="" target="mainFrame">查看品牌</a></font></div>
			<div class="div_lv2"><font id="font1"><a href="" target="mainFrame">添加品牌</a></font></div>
			</td>
		</tr>

		<tr class="clicktab" value="4">
			<td><div id="div_t1"><font id="font1">▶商品管理</font></div></td>
		</tr>
		<tr id="div_t1-4">
			<td>
			<div class="div_lv2-1"><font id="font1"><a href="" target="mainFrame">查看商品/a></font></div>
			<div class="div_lv2"><font id="font1"><a href="" target="mainFrame">添加商品</a></font></div>
			</td>
		</tr>

		<tr class="clicktab" value="5">
			<td><div id="div_t1"><font id="font1">▶订单状态</font></div></td>
		</tr>
		<tr id="div_t1-5">
			<td>
			<div class="div_lv2-1"><font id="font1"><a href="" target="mainFrame">查看订单状态</a></font></div>
			<div class="div_lv2"><font id="font1"><a href="" target="mainFrame">添加订单状态</a></font></div>
			</td>
		</tr>

		<tr class="clicktab" value="6"> 
			<td><div id="div_t1"><font id="font1">▶订单管理</font></div></td>
		</tr>
		<tr id="div_t1-6">
			<td>
			<div class="div_lv2-1"><font id="font1"><a href="" target="mainFrame">查看订单</a></font></div>
			<div class="div_lv2"><font id="font1"><a href="" target="mainFrame">添加订单</a></font></div>
			</td>
		</tr>

	</table>
</body>
<script>
	$(".clicktab").toggle(
		function(){
			value=this.value;
			$("#div_t1-"+value).fadeIn(100);
		},function(){
			value=this.value;
			$("#div_t1-"+value).fadeOut(100);
		}
	);
	
	$(".clicktab").mouseover();
</script>
</html>