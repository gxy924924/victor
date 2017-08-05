<html>
<head>
<meta http-equiv="content-type" content="text/html"charset="utf-8">
<style type="text/css">
li{
	width:50px;
}

</style>
<script type="text/javascript" src="my.js"></script>
<script type="text/javascript">
function change(val,obj){
	if(val=='over'){
		obj.style.color="red";
		obj.style.cursor="hand";
	}else if(val=='out'){
		obj.style.color="black";
	}
}

function openChatRoom(obj){
	window.open("chatRoom.php?username="+obj.innerText,"_blank");
}

</script>
</head>
<body>
<h1>好友列表</h1>
<ul>
<li onmouseover="change('over',this)" onclick="openChatRoom(this)" onmouseout="change('out',this)">松江</li>
<li onmouseover="change('over',this)" onclick="openChatRoom(this)"  onmouseout="change('out',this)">张飞</li>
<li onmouseover="change('over',this)" onclick="openChatRoom(this)"  onmouseout="change('out',this)">小倩</li>
<li onmouseover="change('over',this)" onclick="openChatRoom(this)"  onmouseout="change('out',this)">111</li>
<li onmouseover="change('over',this)" onclick="openChatRoom(this)"  onmouseout="change('out',this)">aaa</li>
</ul>
</body>
</html>