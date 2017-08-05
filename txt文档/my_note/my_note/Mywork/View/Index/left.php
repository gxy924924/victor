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
				<td> <font id="font_title">您好<?=$_SESSION['username']?></font></td>
			</tr>
			<tr>
				<td>
					<font id="font_title">[<a id="font_title" href="<?php echo U_PATH ?>?c=Index&v=goexit" target="_top">退出</a>]</font>
				</td>
			</tr>
		</table>
	</div>
	<!--导航边栏-->
	<table id="table1"  cellpadding=0 cellspacing=0>
		<tr class="clicktab" id="show1">
			<td><div id="div_t1"><font id="font1">▶用户管理</font></div></td>
		</tr>
		<tr class="div_t1-show1" style="display:block;">
			<td >
			<div class="div_lv2-1"><font id="font1"><a href="<?php  echo U_PATH; ?>?c=User&v=index" target="mainFrame">查看用户</a></font></div>
			<div class="div_lv2"><font id="font1"><a href="<?php echo U_PATH?>?c=User&v=add" target="mainFrame">添加用户</a></font></div>
			</td>
		</tr>
		
		<tr class="clicktab" id="show2">
			<td><div id="div_t1"><font id="font1">▶分类管理</font></div></td>
		</tr>
		<tr class="div_t1-show2">
			<td>
			<div class="div_lv2-1"><font id="font1"><a href="<?php echo U_PATH?>?c=Sort&v=show" target="mainFrame">查看分类</a></font></div>
			<div class="div_lv2"><font id="font1"><a href="<?php echo U_PATH?>?c=Sort&v=add" target="mainFrame">添加分类</a></font></div>
			</td>
		</tr>

		<tr class="clicktab" id="show3">
			<td><div id="div_t1"><font id="font1">▶图片管理</font></div></td>
		</tr>
		<tr class="div_t1-show3">
			<td>
			<div class="div_lv2-1"><font id="font1"><a href="<?php echo U_PATH?>?c=Picture&v=show" target="mainFrame">查看图片</a></font></div>
			<div class="div_lv2"><font id="font1"><a href="<?php echo U_PATH?>?c=Picture&v=add" target="mainFrame">添加图片</a></font></div>
			</td>
		</tr>

		<tr class="clicktab" id="show4">
			<td><div id="div_t1"><font id="font1">▶商品管理</font></div></td>
		</tr>
		<tr class="div_t1-show4">
			<td>
			<div class="div_lv2-1"><font id="font1"><a href="" target="mainFrame">查看商品</a></font></div>
			<div class="div_lv2"><font id="font1"><a href="" target="mainFrame">添加商品</a></font></div>
			</td>
		</tr>

		<tr class="clicktab" id="show5">
			<td><div id="div_t1"><font id="font1">▶订单状态</font></div></td>
		</tr>
		<tr class="div_t1-show5">
			<td>
			<div class="div_lv2-1"><font id="font1"><a href="" target="mainFrame">查看订单状态</a></font></div>
			<div class="div_lv2"><font id="font1"><a href="" target="mainFrame">添加订单状态</a></font></div>
			</td>
		</tr>

		<tr class="clicktab" id="show6"> 
			<td><div id="div_t1"><font id="font1">▶订单管理</font></div></td>
		</tr>
		<tr class="div_t1-show6">
			<td>
			<div class="div_lv2-1"><font id="font1"><a href="" target="mainFrame">查看订单</a></font></div>
			<div class="div_lv2"><font id="font1"><a href="" target="mainFrame">添加订单</a></font></div>
			</td>
		</tr>

	</table>
</body>
<script type="text/javascript">
	for(i=1;i<=6;i++){
		$(".div_t1-show"+i).fadeOut(500);
	}
	$(".clicktab").toggle(
		function(){
			id=this.id;
			
			$(".div_t1-"+id).fadeIn(500);
			//$("#div_t1-"+value).hide(100);
			//alert(".div_t1-"+id);
		},function(){
			id=this.id;
			$(".div_t1-"+id).fadeOut(500);
			//$("#div_t1-"+value).show(100);
		}
	);
	
	//$(".clicktab").mouseover();
</script>
</html>