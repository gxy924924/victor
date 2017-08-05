<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once APP."Index/View/Index/title.php"; ?>
	<title><?=$this->article[0]['title']?></title>
	<style>
		.badge{
			background-color: #83CEB4;
			float: right;
			position: relative;
			top:20px;
		}
		.panel-body{
			height: 300px;
		}
		.container-border{
			border: 1px solid #ccc;
			border-radius: 4px;
			margin-bottom: 10px;
			padding-top: 10px;
		}
	</style>
</head>
<body>
	<?php require_once APP."Index/View/Index/header.php"; ?>
	<div class="container container-border">
		<ol class="breadcrumb">
			<?php foreach ($this->bread_type as $val): ?>
				<li><a href="<?=U_PATH?>?m=Index&c=List&v=list_show&type_id=<?=$val['id']?>"><?=$val['type_name']?></a></li>
			<?php endforeach; ?>
			
		</ol>
		<div class="col-md-8">
			<div class="well">
				<h3>标题：
					<?=$this->article[0]['title']?><span class="badge"><?=$this->article[0]['addtime']?></span>
				</h3>

			</div>
			<div class="well">
				<?php require_once $this->article[0]['url']; ?>
			</div>
		
		</div>
		<div class="col-md-4">
			<div class="panel panel-success">
				<div class="panel-heading">
					列表管理
				</div>
				<div class="panel-body">
					其他链接。。。
				</div>
			</div>
		</div>
	</div>	
	<?php require_once APP."Index/View/Index/footer.php"; ?>
</body>
</html>

