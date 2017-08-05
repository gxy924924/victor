<?php /* Smarty version Smarty-3.1-DEV, created on 2017-02-05 18:38:58
         compiled from ".\View\18.html" */ ?>
<?php /*%%SmartyHeaderCode:20605589700c2e0ec21-05370673%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89b86c4b8a89f0346995d3bec93eaf7cb11bd46f' => 
    array (
      0 => '.\\View\\18.html',
      1 => 1486290951,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20605589700c2e0ec21-05370673',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'animal' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_589700c2e4d436_93810348',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_589700c2e4d436_93810348')) {function content_589700c2e4d436_93810348($_smarty_tpl) {?><html>
<head>
<meta http-equiv="content-type" content="text/html"charset="utf-8">
<style>
</style>
</head>
<body>
	<h2>缓存制作</h2>
	<ul>
		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['animal']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
			<li><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</li>
		<?php } ?>
	</ul>
</body>
</html><?php }} ?>
