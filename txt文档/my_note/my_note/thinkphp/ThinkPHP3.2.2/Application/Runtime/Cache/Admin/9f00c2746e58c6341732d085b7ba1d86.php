<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title></title>
</head>
<body>
	<?php if(is_array($rows)): foreach($rows as $key=>$row): ?><h1><?php echo ($rows['id']); ?>--<?php echo ($rows['name']-<?php echo ($rows["password"]); ?>); ?>-</h1><?php endforeach; endif; ?>
</body>
</html>