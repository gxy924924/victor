<?php /* Smarty version Smarty-3.1-DEV, created on 2017-02-05 17:47:59
         compiled from ".\View\10.html" */ ?>
<?php /*%%SmartyHeaderCode:185875894630b3b0e18-46928377%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f06aea36a59cd8cc745566e9c408440b21a33c45' => 
    array (
      0 => '.\\View\\10.html',
      1 => 1486120515,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '185875894630b3b0e18-46928377',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5894630b3ef620_70774080',
  'variables' => 
  array (
    'outval' => 0,
    'seled' => 0,
    'area' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5894630b3ef620_70774080')) {function content_5894630b3ef620_70774080($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_checkboxes')) include 'D:\\web\\smarty\\libs\\plugins\\function.html_checkboxes.php';
if (!is_callable('smarty_function_html_options')) include 'D:\\web\\smarty\\libs\\plugins\\function.html_options.php';
?><html>
<head>
<meta http-equiv="content-type" content="text/html"charset="utf-8">
<style>
</style>
</head>
<body>
	<h2>复选框应用</h2>
	爱好：</br>
	<?php echo smarty_function_html_checkboxes(array('name'=>"hobby",'options'=>$_smarty_tpl->tpl_vars['outval']->value,'label_ids'=>true,'selected'=>$_smarty_tpl->tpl_vars['seled']->value,'separator'=>"</br>",'labels'=>false),$_smarty_tpl);?>
</br>
<!--	<input type="checkbox" name="hobby[]" value="a">篮球</br>
	<input type="checkbox" name="hobby[]" value="b">排球</br>
	<input type="checkbox" name="hobby[]" value="c">棒球</br>
	<input type="checkbox" name="hobby[]" value="d">看书</br>
	-->
	<h2>下拉列表应用</h2>
	<?php echo smarty_function_html_options(array('name'=>"city",'options'=>$_smarty_tpl->tpl_vars['area']->value,'selected'=>$_smarty_tpl->tpl_vars['seled']->value,'multiple'=>"multiple"),$_smarty_tpl);?>

</body>
</html><?php }} ?>
