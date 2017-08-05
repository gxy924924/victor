<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once APP."Index/View/Index/title.php"; ?>
	<title>js_test</title>
	<style>
		.row{
			padding-top: 20px;
		}
	</style>
</head>
<body>
	<?php require_once APP."Index/View/Index/header.php"; ?>
	
	<div class="container">
		<div class="panel panel-success">
			<div class="panel-heading">
				添加分类
			</div>
			<div class="panel panel-body">
				
				<form action="<?=U_PATH?>?m=Index&c=List&v=type_admin_sql_add" method="post">
					<div class="input-group">
						<span class="input-group-addon">分类名称：</span>
						<input type="text" name="type_name" class="form-control">
					</div>
					<div class="input-group">
						<span class="input-group-addon">父类选择：</span>
						<select name="parent_type_id" class="form-control" id="">
							<option value="0">无父类</option>
							<?php foreach ($this->type as $val):?>
							<option value="<?=$val['id']?>">id=<?=$val['id']?>|lv=<?=$val['sort_level']?>|<?=$val['type_name']?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="row">
						<div class="col-xs-6 text-center">
							<input type="submit" class="btn btn-primary" value="确认添加">
						</div>
						<div class="col-xs-6 text-center">
							<a class="btn btn-primary" >刷新本页</a>
						</div>
					</div>
						
					
				</form>
			</div>
		</div>
		
		<style>
			.list-group{
				border: 1px solid #ddd;
				border-radius:4px;
			}
			.badge1{
				float:right;
			}
			.pull-right{
				position: relative;
				top: -5px;

			}
			
		</style>
		<div class="panel panel-success">
			<div class="panel-heading">
				分类显示
				<a href="<?=U_PATH?>?m=Index&c=List&v=sort_type_page_input" class="btn btn-primary btn-sm pull-right">生成分类页</a>
				
			</div>
			<div class="panel panel-body">
				<?=$this->show;?>
				
			</div>
		</div>
	</div>
	<script>
		$('.btn-xs').click(function(){
			var cof=confirm("是否删除项目及其子项目");
			return cof;
		});
	</script>
</body>
</html>
