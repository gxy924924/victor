<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once APP."Index/View/Index/title.php"; ?>
	<title>js_test</title>
	<style>
		.goright{
			float: right;
			position: relative;
			top:-5px;
			margin-left:10px; 
		}
		.font-style{
			color: #aaa;
		}
		.btn-xs{
			margin-right: 10px;
			padding: 2px 10px;
		}

	</style>
</head>
<body>
	<?php require_once APP."Index/View/Index/header.php"; ?>
	
	<div class="container">
		<div class="row">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>管理文章列表</h4>&nbsp
						<a  href="<?=U_PATH?>?m=Index&c=List&v=article_admin" class="btn btn-primary btn-sm goright">管理文章</a>
						<!-- <a  href="<?=U_PATH?>?m=Index&c=List&v=list_admin" class="btn btn-primary btn-sm  goright">管理列表</a> -->
						<a  href="<?=U_PATH?>?m=Index&c=List&v=type_admin" class="btn btn-primary btn-sm  goright">管理分类</a>
					
				</div>
				<div class="list-group">
					<!-- <pre>
						<?php // var_dump($this->type) ?>
					</pre> -->
					<div class="list-group-item">
							
						</div>
					<?php foreach ($this->type as $val) : ?>
						<a href="<?=U_PATH?>?m=Index&c=List&v=article_show&id=<?=$val['id']?>" class="list-group-item">
							<div class="media">
								<h4><?=$val['title']?></h4>
								<font class="font-style"><?=$val['article_describe']?></font>
								<span class="badge pull-right"><?=$val['addtime']?></span>
							</div>
							
						</a>
						<div class="list-group-item text-right">
							<a href="<?=U_PATH?>?m=Index&c=List&v=.....&id=<?=$val['id']?>" class="btn btn-warning btn-xs">修改(待开发)</a>
							<a href="<?=U_PATH?>?m=Index&c=List&v=article_admin_del&id=<?=$val['id']?>" name="<?=$val['title']?>" class="btn btn-danger btn-xs">删除</a>
						</div>
					<?php endforeach; ?>
					<!-- <a href="" class="list-group-item">内容<span class="badge">year-mounth-date</span></a> -->
				</div>
			</div>
		</div>
	</div>
	<script>
		$(".btn-danger").click(function(){
			var name=$(this).attr("name");
			return confirm("确认要删除"+name+"吗?");
			// body...
		});
	</script>
</body>
</html>

