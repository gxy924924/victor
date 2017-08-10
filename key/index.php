<?php 
require_once "get_url.php";
$info=keyword_url_get();


?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$info['keyword']?></title>
	<style type="text/css">
	img{
		width:200px;
		height: 200px;
	}
	</style>
</head>
<body>
<?php foreach ($info as $key => $value): ?>
	<?php if (!empty($value['url'])): ?>
		<img src="<?=$value['url']?>" alt="<?=$info['keyword']?>" title="<?=$info['keyword']?>"><br/>
	<?php endif ?>
	
<?php endforeach ?>
</body>
</html>