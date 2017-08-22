<?php 
$serv_arr=explode('/', $_SERVER['REQUEST_URI']);
$add_url="/";
foreach ($serv_arr as $key => $val) {
	if(!empty($val)){
		if($val=="tp5.php"){
			break;
		}else{
			$add_url.=$val."/";
		}
	}
}
$host=$_SERVER['HTTP_HOST'];
$url_before=$host.$add_url."tp5.php";
// if(empty())
$url_this="http://".$host.$add_url;

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>索兰黛七夕专版</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        
        <link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
	    $(function(){
        // 页面浮动面板
        $("#floatPanel > .ctrolPanel > a.arrow").eq(0).click(function(){$("html,body").animate({scrollTop :0}, 800);return false;});
        $("#floatPanel > .ctrolPanel > a.arrow").eq(1).click(function(){$("html,body").animate({scrollTop : $(document).height()}, 800);return false;});
        var objPopPanel = $("#floatPanel > .popPanel");	
        var w = objPopPanel.outerWidth();
        $("#floatPanel > .ctrolPanel > a.qrcode").bind({
            mouseover : function(){
                        objPopPanel.css("width","0px").show();
                        objPopPanel.animate({"width" : w + "px"},300);return false;
                },
                mouseout : function(){
                        objPopPanel.animate({"width" : "0px"},300);return false;
                        objPopPanel.css("width",w + "px");
            }	
        });
    });
</script>

	<style type="text/css">
	#distpicker5{
		width:100%;
	}
	.margin-tb{
		margin-top: 10px;
		margin-bottom: 10px;
	}

	</style>
        
<!-- <style> 
.div-right{width:70px;height:20px;border:1px solid #000;float:right} 
/* css注释说明：float:left设置居左靠左 */ 
</style> -->
	</head>
	<body>
<!-- <div class="div-right"><a href="#Bot">一键到底</a></div> 

<a href="javascript:window.scrollTo( 1000, 4100 );" >到底</a> -->
		<!-- Wrapper-->
			<div id="wrapper">

				<!-- Nav -->
					<nav id="nav">
                    <p>索兰黛七夕专版</p>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Me -->
							<article id="me" class="panel">
								<header>
									<h1>标题</h1>
									<p>内容</p>
								</header>
								<a href="#work" class="jumplink pic">
									<span class="arrow icon fa-chevron-right"><span>内容</span></span>
									<img src="images/me.jpg" alt="" />
								</a>
							</article>

						<!-- Work -->
							<article id="work" class="panel">
								<header>
									<h2>标题</h2>
								</header>
								<p>
									内容
								</p>
								<section>
									<div class="row">
										<div class="4u 12u$(mobile)">
											<a href="#" class="image fit"><img src="images/pic01.jpg" alt=""></a>
										</div>
										<div class="4u 12u$(mobile)">
											<a href="#" class="image fit"><img src="images/pic02.jpg" alt=""></a>
										</div>
										<div class="4u$ 12u$(mobile)">
											<a href="#" class="image fit"><img src="images/pic03.jpg" alt=""></a>
										</div>
										<div class="4u 12u$(mobile)">
											<a href="#" class="image fit"><img src="images/pic04.jpg" alt=""></a>
										</div>
										<div class="4u 12u$(mobile)">
											<a href="#" class="image fit"><img src="images/pic05.jpg" alt=""></a>
										</div>
										<div class="4u$ 12u$(mobile)">
											<a href="#" class="image fit"><img src="images/pic06.jpg" alt=""></a>
										</div>
										<div class="4u 12u$(mobile)">
											<a href="#" class="image fit"><img src="images/pic07.jpg" alt=""></a>
										</div>
										<div class="4u 12u$(mobile)">
											<a href="#" class="image fit"><img src="images/pic08.jpg" alt=""></a>
										</div>
										<div class="4u$ 12u$(mobile)">
											<a href="#" class="image fit"><img src="images/pic09.jpg" alt=""></a>
										</div>
										<div class="4u 12u$(mobile)">
											<a href="#" class="image fit"><img src="images/pic10.jpg" alt=""></a>
										</div>
										<div class="4u 12u$(mobile)">
											<a href="#" class="image fit"><img src="images/pic11.jpg" alt=""></a>
										</div>
										<div class="4u$ 12u$(mobile)">
											<a href="#" class="image fit"><img src="images/pic12.jpg" alt=""></a>
										</div>
									</div>
								</section>
							</article>

						<!-- Contact -->
							<article id="contact" class="panel">
								<header>
									<h2>联系我们</h2>
								</header>
								<form action="http://<?=$url_before ?>/api/notification/activity_guest_info_add.html" method="post" target="_self">
									<div>
										<div class="row">
											<input type="hidden" name="url" value="<?=$url_this?>">

											<div class="6u 12u$(mobile)">
												<input type="text" class="form-control" placeholder="请填写姓名" name="name" id="guest_name">
											</div>

											<div class="6u 12u$(mobile)">
												<input type="text" class="form-control" placeholder="请填写联系电话" name="phone" id="phone">
											</div>

											<div class="6u 12u$(mobile)">
												<input type="text" class="form-control" placeholder="请填写微信号" name="weixin" id="weixin">
											</div>


											<div id="distpicker5">
												<div class="form-group">
													<label class="sr-only" for="province10">Province</label>
													<select class="form-control" name="city_provice" id="province10"></select>
												</div>
												<div class="form-group margin-tb"  >
													<label class="sr-only" for="city10">City</label>
													<select class="form-control" id="city10" name="city_city"></select>
												</div>
												<div class="form-group">
													<label class="sr-only" for="district10">District</label>
													<select class="form-control" id="district10" name="city_county"></select>
												</div>
											</div>



											<div class="12u$">
												<textarea class="form-control" name="remark" placeholder="请填写备注" rows="8"></textarea>
											</div>
											<div class="12u$">
												<button type="submit" class="btn btn-primary text-center btn-full btn-lg" id='add_new_submit'>提交</button>

											</div>
										</div>
									</div>
								</form>
							</article>

					</div>
<a name="Bot">
				<!-- Footer -->
					<div id="footer">
						<ul class="copyright">
							<li>&copy; Maria.</li><li>Design: <a href="http://www.maria.cn">玛瑞娅技术部</a></li>
						</ul>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
<div style="text-align:center;margin:3px 0">
<!--浮动面板-->
<div id="floatPanel">
	<div class="ctrolPanel">
		<a class="arrow" href="#"><span>顶部</span></a><a class="contact" href="" target="_blank"><span>反馈</span></a><a class="qrcode" href="#"><span>微信二维码</span></a><a class="arrow" href="#"><span>底部</span></a></div>
	<div class="popPanel">
		<div class="popPanel-inner">
			<div class="qrcodePanel">
				<img src="images/weixin.jpg" /><span>扫描二维码关注我们为好友</span></div>
			<div class="arrowPanel">
				<div class="arrow01">
				</div>
				<div class="arrow02">
				</div>
			</div>
		</div>
	</div>
</div>
	</body>

		<script src="http://www.jq22.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://www.jq22.com/jquery/bootstrap-3.3.4.js"></script>
	<script src="js/distpicker.data.js"></script>
	  <script src="js/distpicker.js"></script>
	  <script src="js/main.js"></script>
	<script>
	

	$("#add_new_submit").click(function(){
		var arr1=new Array();//表单id信息
		arr1=['guest_name','phone','weixin'];
		var arr2=new Array();//表单ID内容
		arr2=['输入姓名','输入电话',"微信号"];
		for (var i =  0; i < arr1.length; i++) {
			id_info="#"+arr1[i];
				
			if(!$(id_info).val()){

				alert('请'+arr2[i]);

				return false;
			}
		}
		alert('发送成功');
	});
	</script>
</html>