<?php /* Smarty version Smarty-3.1-DEV, created on 2017-02-03 11:35:03
         compiled from ".\View\09.html" */ ?>
<?php /*%%SmartyHeaderCode:157965893f8d82f1e80-44773191%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '90643230bc23f063d2bcbe5537eb05c6b2c7d3a4' => 
    array (
      0 => '.\\View\\09.html',
      1 => 1486092895,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157965893f8d82f1e80-44773191',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5893f8d8324b17_41557483',
  'variables' => 
  array (
    'week' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5893f8d8324b17_41557483')) {function content_5893f8d8324b17_41557483($_smarty_tpl) {?><html>
<head>
<meta http-equiv="content-type" content="text/html"charset="utf-8">
<style>
</style>
</head>
<body>
	<h2>分支结构语句</h2>
	<?php if ($_smarty_tpl->tpl_vars['week']->value==1) {?>
		星期一</br>
	<?php } elseif ($_smarty_tpl->tpl_vars['week']->value==2) {?>
		星期二</br>
	<?php } elseif ($_smarty_tpl->tpl_vars['week']->value==3) {?>
		星期三</br>
	<?php } elseif ($_smarty_tpl->tpl_vars['week']->value==4) {?>
		星期四</br>
	<?php  } else { if (!isset($_smarty_tpl->tpl_vars['week'])) $_smarty_tpl->tpl_vars['week'] = new Smarty_Variable(null);if ($_smarty_tpl->tpl_vars['week']->value = 5) {?>
		星期五</br>
	<?php } else { ?>
		周末</br>
	<?php }}?>

	<?php if ($_smarty_tpl->tpl_vars['week']->value+2==5) {?>
		星期三</br>
	<?php } elseif ($_smarty_tpl->tpl_vars['week']->value+2==6) {?>
		星期四</br>
	<?php }?>
</body>
</html><?php }} ?>
