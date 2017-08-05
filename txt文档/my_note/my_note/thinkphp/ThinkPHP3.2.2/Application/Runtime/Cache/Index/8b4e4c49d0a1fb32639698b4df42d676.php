<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title></title>
</head>
<body>
	<h1>foreach</h1>
	<?php if(is_array($rows)): foreach($rows as $k=>$val): if($k%2 == 0): ?><h2 style="background-color:#ccc;"><?php echo ($k); ?>==><?php echo ($val['username']); ?></h2>
		<?php else: ?>
		<h2><?php echo ($k); ?>==><?php echo ($val['username']); ?></h2><?php endif; endforeach; endif; ?>
	<?php switch($week): case "1": ?>111<?php break;?>
		<?php case "3": ?>3<?php break;?>
		<?php case "5": ?>55<?php break; endswitch;?>
	<?php echo ($state==1?'1':'2'); ?>
</body>
</html>