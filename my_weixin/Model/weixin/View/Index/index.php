<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once APP."Index/View/Index/title.php"; ?>
	<title>微信功能测试</title>
		<style>
		#mytitle{
			height: 40px;
		}
	</style>
</head>
<body>
	<?php require_once APP."Index/View/Index/header.php"; ?>
	<div class="container">
		<div class="row">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>标题</h4>
				</div>
				<div class="list-group">
					<a href="<?=U_PATH?>?m=Index&c=Index&v=sql_test" class="list-group-item">数据库测试<span class="badge">year-mounth-date</span></a>
					<a href="<?=U_PATH?>?m=weixin&c=Index&v=weixinchat" class="list-group-item">微信token测试<span class="badge">year-mounth-date</span></a>
					<a href="<?=U_PATH?>?m=weixin&c=Index&v=weixin_userinfo" class="list-group-item">userinfo<span class="badge">year-mounth-date</span></a>
					<a href="" class="list-group-item">内容<span class="badge">year-mounth-date</span></a>

					<a href="<?=U_PATH?>?m=weixin&c=Index&v=weixin_menu" class="list-group-item">微信menu<span class="badge">year-mounth-date</span></a>
					<a href="<?=U_PATH?>?m=Index&c=Index&v=js_test" class="list-group-item">js_test<span class="badge">year-mounth-date</span></a>
					<a href="<?=U_PATH?>?m=weixin&c=Index&v=jump_test" class="list-group-item">jump页面查看<span class="badge">year-mounth-date</span></a>
					<a href="" class="list-group-item">内容<span class="badge">year-mounth-date</span></a>
				</div>
			</div>
		</div>
	</div>

	<?php require_once INDEX_VIEW."footer.php"; ?>
</body>
</html>