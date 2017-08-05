<?php /* Smarty version Smarty-3.1-DEV, created on 2017-01-23 13:16:19
         compiled from ".\View\05.html" */ ?>
<?php /*%%SmartyHeaderCode:1176058857ad9e9a7d9-12487712%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd65cba40cfe80acb4a393c2217fb5b2ae7aad04d' => 
    array (
      0 => '.\\View\\05.html',
      1 => 1485148576,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1176058857ad9e9a7d9-12487712',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_58857ad9ed5163_52574969',
  'variables' => 
  array (
    'fruit' => 0,
    'animal' => 0,
    'test' => 0,
    'k' => 0,
    'v' => 0,
    'key' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58857ad9ed5163_52574969')) {function content_58857ad9ed5163_52574969($_smarty_tpl) {?><html>
<head>
<meta http-equiv="content-type" content="text/html"charset="utf-8">
<style>
</style>
</head>
<body>
<h2>数组元素访问</h2>
<div><?php echo $_smarty_tpl->tpl_vars['fruit']->value[2];?>
</div>
<div><?php echo $_smarty_tpl->tpl_vars['fruit']->value[3];?>
</div>
<div><?php echo $_smarty_tpl->tpl_vars['animal']->value['huaGS'];?>
</div>
<div><?php echo $_smarty_tpl->tpl_vars['animal']->value['deguo'];?>
</div>
<div><?php echo $_smarty_tpl->tpl_vars['animal']->value['northeast'];?>
</div>
多维数组：
<div>tese(0,0):<?php echo $_smarty_tpl->tpl_vars['test']->value[0][0];?>
</div>
<div>tese(1,1):<?php echo $_smarty_tpl->tpl_vars['test']->value[1][1];?>
</div>

</br>遍历:fruit
<div><?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fruit']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['v']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
 $_smarty_tpl->tpl_vars['v']->iteration++;
?>
	<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
--<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</br>
	<?php }
if (!$_smarty_tpl->tpl_vars['v']->_loop) {
?>
	数组为空</br>
	<?php } ?>
</div>

</br>遍历关联数组:animal
<div><?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['animal']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['v']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
 $_smarty_tpl->tpl_vars['v']->iteration++;
?>
	<?php echo $_smarty_tpl->tpl_vars['v']->iteration;?>
--<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
--<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</br>
	<?php }
if (!$_smarty_tpl->tpl_vars['v']->_loop) {
?>
	数组为空</br>
	<?php } ?>
</div>

</br>遍历多维数组:test
<div><?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['test']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
	<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
==></br><?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['val']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['v']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
 $_smarty_tpl->tpl_vars['v']->iteration++;
?><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
-><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</br> <?php }
if (!$_smarty_tpl->tpl_vars['v']->_loop) {
?>
	数组为空</br><?php } ?></br>
	<?php }
if (!$_smarty_tpl->tpl_vars['val']->_loop) {
?>
	数组为空</br>
	<?php } ?>
</div>
</body>
</html><?php }} ?>
