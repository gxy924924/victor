<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once APP."Index/View/Index/title.php"; ?>
	<title>list_show</title>
	<style>


	</style>
</head>
<body>
	<?php require_once APP."Index/View/Index/header.php"; ?>
	
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
			<?php if(!empty($this->type_res)): ?>
				<h3> 标题: <?=$this->type_res[0]['type_name']?> ( 及其子标题中的内容 )</h3>
			<?php elseif(!empty($_POST['search'])): ?>
				<h3> 标题: 搜索内容(<?=$_POST['search']?>) </h3>
			<?php else: ?>
				<h3> 标题: 所有内容 </h3>
			<?php endif; ?>
			</div> 
				
				<div class="list-group">
					<!-- <pre>
						<?php var_dump($this->type) ?>
					</pre> -->
				<?php if(empty($this->list_res)): ?>
					<div class="list-group-item">
						无此内容。。。
					</div>
				<?php else: ?>
					<?php foreach ($this->list_res as $val) : ?>
						<a href="<?=U_PATH?>?m=Index&c=List&v=article_show&id=<?=$val['id']?>" class="list-group-item">
							<div class="media">
								<h4><?=$val['title']?><span class="badge"><?=$val['type_id']?><?=$val['type_name']?></span></h4>
								<font class="font-style"><?=$val['article_describe']?></font>
								<span class="badge pull-right"><?=$val['addtime']?></span>
							</div>
							
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
					<!-- <a href="" class="list-group-item">内容<span class="badge">year-mounth-date</span></a> -->
				</div>
		</div>
	</div>
</body>
</html>
