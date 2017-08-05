<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once APP."Index/View/Index/title.php"; ?>
	<title>js_test</title>
	<style>
		textarea{
			width:100%;
			border:0;
		}
		.top-margin{
			margin-top: 20px;
		}
		.btn-primary{
			margin-left: 30px;
		}
		font{
			color: #ccc;
		}
		.media-object{
			width: 100px;
			height: 100px;
		}
	</style>
</head>
<body>
	<?php require_once APP."Index/View/Index/header.php"; ?>
	<div class="container">
		<div class="panel panel-success">
			<div class="panel-heading">
				添加文章
			</div>
			<div class="panel-body">
				<form action="<?=U_PATH?>?m=Index&c=List&v=article_admin_add" method="post">
					<div class="input-group">
						<span class="input-group-addon">类型:  </span>
						<select name="type_id" class="form-control" id="">
							<option value="0 无类型">无类型</option>
							<?php foreach ($this->type as $val):?>
							<option value="<?=$val['id']?> <?=$val['type_name']?>">id=<?=$val['id']?>|lv=<?=$val['sort_level']?>|<?=$val['type_name']?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">标题:  </span>
						<input type="text" name="title" class="form-control">
					</div>
					<div class="input-group">
						<span class="input-group-addon">描述:  </span>
						<input type="text" name="article_describe" class="form-control">
					</div>
					<div class="panel panel-info">
						<div class="panel-heading">
							内容
							<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#pic_control">图片管理</button>
						</div>
						<textarea name="content" id="" cols="30" rows="10"></textarea>
					</div>
					<div class="row text-center">
						<div class="col-xs-6">
							<input type="submit" value="确认添加" class="btn btn-success">
						</div>
						<div class="col-xs-6">
							<a href="<?=U_PATH?>?m=Index&c=List&v=article_admin" class="btn btn-info">刷新页面</a>
						</div>
					</div>
				</form>	
			</div>
		</div>
		
		<div class="modal fade bs-example-modal-lg" id="pic_control" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4>
							图片管理
							<button class="close pull-right" data-dismiss='modal'>&times;</button>
						</h4>
						
					</div>
					<div class="modal-body">
						<div role="tabpanel">

						  <!-- Nav tabs -->
						  <ul class="nav nav-tabs" role="tablist">
						    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
						    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
						   
						  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
						    <div role="tabpanel" class="tab-pane active" id="home">
						    <?php foreach ($this->image_info as $key => $val):?>
								<div class="media">
									<div class="media-left">
										<img src="./Model/Index/Upload/Image/<?=$val['basename']?>" alt="" class="media-object">
									</div>
									<div class="media-body">
										<h4 class="media-heading"><?=$val['name']?></h4>
										<font>	请复制以下内容使图片显示在文档中	</font>
										<textarea name="" id="" cols="30" rows="3" ><img src="./Model/Index/Upload/Image/<?=$val['basename']?>" alt=""></textarea>
										
									</div>
								</div>

							<?php endforeach; ?>
						    </div>
						    <div role="tabpanel" class="tab-pane" id="profile">
						    	<form action="" method="post">
						    		
						    	</form>
						    </div>

						  </div>

						</div>



							
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" data-dismiss="modal">返回</button>
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-success">
			<div class="panel-heading">
				导入文章(暂未开放)
			</div>
			<div class="panel-body">
				<form action="<?=U_PATH?>?m=Index&c=List&v=article_admin_add" method="post">
					<div class="input-group">
						<span class="input-group-addon">类型:  </span>
						<select name="type_name" class="form-control" id="">
							<option value="0">无类型</option>
							<?php foreach ($this->type as $val):?>
							<option value="<?=$val['id']?>">id=<?=$val['id']?>|lv=<?=$val['sort_level']?>|<?=$val['type_name']?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">标题:  </span>
						<input type="text" name="title" class="form-control">
					</div>
					<div class="input-group">
						<span class="input-group-addon">描述:  </span>
						<input type="text" name="describe" class="form-control">
					</div>
					<div class="input-group">
						<span class="input-group-addon">文件:  </span>
						<input type="file" name="describe" class="form-control">
					</div>
					<div class="row text-center top-margin">
						<div class="col-xs-6">
							<input type="submit" value="确认添加" class="btn btn-success" onclick="return false">
						</div>
						<div class="col-xs-6">
							<a href="<?=U_PATH?>?m=Index&c=List&v=article_admin" class="btn btn-info">刷新页面</a>
						</div>
					</div>
					
				</form>	
			</div>
		</div>

	</div>		
</body>
</html>