	<div class="container" id="mytitle">
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
				<button  class="navbar-toggle" data-toggle="collapse" data-target='#myheader' id="top_navbarbtn">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div style="margin-left:15px;">
					<p class="navbar-text">
					
					<?php if(!empty($this->res)):?>

						<span>欢迎：<?=$this->res['nickname']?></span>
					<?php endif; ?>
						<a href="<?=U_PATH?>?m=Index&c=Index&v=index" class="navbar-link">快乐之鱼的个人网站</a>
					</p>
				</div>
			</div>
			<div class="collapse navbar-collapse text-right" id='myheader' >
				<ul class="nav navbar-nav">
					<li class="text-center"><a href="<?=U_PATH?>?m=weixin&c=Index&v=index">微信开发</a></li>
					<li class="text-center"><a href="<?=U_PATH?>?m=Index&c=List&v=index">List</a></li>
					<li class="text-center"><a data-toggle="modal" data-target="#mymodal">标题</a></li>
					<li class="text-center"><a href="<?=U_PATH?>?m=Index&c=Image&v=index">图片管理</a></li>
				</ul>
				<form action="<?=U_PATH?>?m=Index&c=List&v=list_show" method="post" class="navbar-form">
					<div class="form-group">
						<input type="text" name="search" class="form-control" placeholder="AA空格AA-多重条件">
						<input type="submit" class="btn btn-primary form-control" value="search">
					</div>
				</form>
			</div>
		</div>
		<div class="modal fade bs-example-modal-lg" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4>
							类型查询
							<button class="close pull-right" data-dismiss='modal'>&times;</button>
						</h4>
						
					</div>
					<div class="modal-body">
						<div>
							<ul class='list-group'>
								<li class='list-group-item'>
									<a class='btn btn_primary' href='/my_weixin/index.php?m=Index&c=List&v=list_show&type_id=0'>
										&nbsp&nbsp&nbsp所有内容
									</a>
								</li>
							</ul>
						</div>
						<?php require_once APP."Index/View/Index/sort_type_page.php"; ?>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" data-dismiss="modal">返回</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		
	$("#top_navbarbtn").click(function(){
			// alert("aaa");
			$("#myheader").toggle();
		})
	</script>