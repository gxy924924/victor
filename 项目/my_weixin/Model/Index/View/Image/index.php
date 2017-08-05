<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once APP."Index/View/Index/title.php"; ?>
	<title>image_controller</title>
	<style>
		.col-xs-6{
			margin-top: 20px;
			
		}
		.col-md-6{
			margin:15px 0;
			padding: 0;
		}
	
		img{
			width: 120px;
			height: 120px;
		}

	@media screen and (max-width: 990px){
		.col-xs-4{
			margin: 10px 0;
		}

		img{
			width: 90px;
			height: 90px;
		}
	}
		
	</style>
</head>
<body>
	<?php require_once APP."Index/View/Index/header.php"; ?>
	
	<div class="container">
		<div class="panel panel-success">
			<div class="panel-heading">
				添加图片
			</div>
			<div class="panel-body">
				<form action="<?=U_PATH?>?m=Index&c=Image&v=iamge_upload" method="post" enctype="multipart/form-data">
					<div class="input-group">
						<span class="input-group-addon">图片:</span>
						<input type="file" name="img_file" class="form-control">
					</div>
					<div class="list-group text-center">
						<a class="list-group-item" id="add_more">添加更多图片</a>
					</div>
					<div>
						<div class="col-xs-6 text-center">
							<input type="submit" class="btn btn-primary btn-lg	">
						</div>
						<div class="col-xs-6 text-center">
							<a type="submit" class="btn btn-primary btn-lg	">刷新</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="panel panel-success">
			<div class="panel-heading">
				管理图片
			</div>
			<div class="panel-body">
				<div class="col-md-6">
				<?php foreach ($this->img as $key => $val):?>
				<?php if($key%3==0&&$key): ?>
					</div>
					<div class="col-md-6">
				<?php endif; ?>
					<div class="col-xs-4">
						<img src="./Model/Index/Upload/Image/<?=$val['basename']?>" class="thumbnail " alt="">
					</div>
				<?php endforeach; ?>
				</div>



				<?php $arr= array(1,1,1,1,1,1,1,1); ?>
				<div class="col-md-6">
				<?php foreach ($arr as $key => $value):?>
				<?php if($key%3==0&&$key): ?>
					</div>
					<div class="col-md-6">
				<?php endif; ?>
					<div class="col-xs-4">
						<img src="holder.js/100x100" alt="">
					</div>
				<?php endforeach; ?>
				</div>
				
					
			</div>
		</div>
	</div>
	<script>
		i=0;

		$("#add_more").click(function(){
			i++;
			var add_info="<div class='input-group'><span class='input-group-addon'>图片:</span><input type='file' name='img_file"+i+"' class='form-control'></div>";
			$("#add_more").before(add_info);
					// alert(add_info);
		});
	</script>
</body>
</html>
