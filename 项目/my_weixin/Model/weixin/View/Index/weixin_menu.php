<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>weixin_menu</title>
	<?php require_once INDEX_VIEW."title.php"; ?>
	<style>
		.container{
			padding-top: 50px;
		}
		iframe{
			width: 100%;
			height:300px;
		}
	</style>
</head>
<body>
	<?php require_once INDEX_VIEW."header.php"; ?>
	<div class="container">
		
		<div class="col-md-2">
			<a href="<?=U_PATH?>?m=weixin&c=Index&v=weixin_menu_action&act=get_acToken" class="btn btn-primary" target="show_menu">get_acToken</a>
		</div>
		<div class="col-md-2">
			<a href="<?=U_PATH?>?m=weixin&c=Index&v=weixin_menu_action&act=set_menu" class="btn btn-primary" target="show_menu">set_menu</a>
		</div>
		<div class="col-md-2">
			<a href="<?=U_PATH?>?m=weixin&c=Index&v=weixin_menu_action&act=show_menu" class="btn btn-primary" target="show_menu">show_menu</a>
		</div>
		<div class="col-md-2">
			<a href="<?=U_PATH?>?m=weixin&c=Index&v=weixin_menu_action&act=delete_menu" class="btn btn-primary" target="show_menu">delete_menu</a>
		</div>
		<div class="col-md-2">
			<a href="<?=U_PATH?>?m=weixin&c=Index&v=weixin_menu_action&act=show_user_info" class="btn btn-primary" target="show_menu">show_user_info(暂不可用)</a>
		</div>
	</div>
	<div class="container">
		<iframe src="" frameborder="1" name="show_menu" title="show_menu"></iframe>
	</div>
	
</body>
</html>