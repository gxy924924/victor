<?php /* Smarty version Smarty-3.1-DEV, created on 2017-02-03 11:25:23
         compiled from ".\View\03.html" */ ?>
<?php /*%%SmartyHeaderCode:6462588565e54fb2f0-28446642%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '875eda63459c24c27549f2e943f5b7a7a58e7682' => 
    array (
      0 => '.\\View\\03.html',
      1 => 1486092313,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6462588565e54fb2f0-28446642',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_588565e56c0556_52746339',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_588565e56c0556_52746339')) {function content_588565e56c0556_52746339($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("site.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars(null, 'local'); ?>
//配置信息
<html>
<head>
<meta http-equiv="content-type" content="text/html"charset="utf-8">
</head>
<body>
<h2>配置变量的使用</h2>
	<?php echo $_smarty_tpl->getConfigVariable('NETWORK');?>
</br>
	<?php echo $_smarty_tpl->getConfigVariable('POLICE');?>
</br>
	<?php echo $_smarty_tpl->getConfigVariable('DONG');?>
</br>
	也可以这样访问：<?php echo $_smarty_tpl->getConfigVariable('DONG');?>
</br>
	数字不加引号会认为是数字（有最大值限制）：<?php echo $_smarty_tpl->getConfigVariable('Money');?>
</br>
	数字加引号会认为是字串<?php echo $_smarty_tpl->getConfigVariable('Money2');?>
</br>
</body>
</html><?php }} ?>
