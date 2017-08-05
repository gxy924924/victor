<?php /* Smarty version Smarty-3.1-DEV, created on 2017-02-05 17:56:11
         compiled from ".\View\16.html" */ ?>
<?php /*%%SmartyHeaderCode:241805896edea140456-55606675%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8849b7de0c2ca1be3d83b822569c31edd78d3a4' => 
    array (
      0 => '.\\View\\16.html',
      1 => 1486288567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '241805896edea140456-55606675',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5896edea270fa9_39744568',
  'variables' => 
  array (
    'addr' => 0,
    'baidu' => 0,
    'title' => 0,
    'talk' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5896edea270fa9_39744568')) {function content_5896edea270fa9_39744568($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\web\\smarty\\libs\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_modifier_truncate')) include 'D:\\web\\smarty\\libs\\plugins\\modifier.truncate.php';
?><html>
<head>
<meta http-equiv="content-type" content="text/html"charset="utf-8">
<style>
</style>
</head>
<body>
	smarty.now=><?php echo time();?>
</br>
	smarty.now|date_format=><?php echo smarty_modifier_date_format(time());?>
</br>
	<?php echo smarty_modifier_date_format(time(),"%Y-%m-%d %H:%M:%S");?>
</br>
	default_addr=><?php echo (($tmp = @$_smarty_tpl->tpl_vars['addr']->value)===null||$tmp==='' ? "beijing" : $tmp);?>
</br>
	escape_baidu=><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['baidu']->value, ENT_QUOTES, 'ISO-8859-1', true);?>
</br>
	缩进=》<?php echo preg_replace('!^!m',str_repeat('hello',4),$_smarty_tpl->tpl_vars['baidu']->value);?>
</br>
	\n换< /br>=></br><?php echo nl2br($_smarty_tpl->tpl_vars['title']->value);?>
</br>
	truncate=><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['talk']->value,20,"..",true);?>

	嵌套使用调节器=><?php echo strtoupper(smarty_modifier_truncate($_smarty_tpl->tpl_vars['talk']->value,20,"..",true,true));?>

</body>
</html><?php }} ?>
