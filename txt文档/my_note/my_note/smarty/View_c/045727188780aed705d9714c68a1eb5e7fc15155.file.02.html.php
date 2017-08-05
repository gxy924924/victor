<?php /* Smarty version Smarty-3.1-DEV, created on 2017-02-03 11:24:18
         compiled from ".\View\02.html" */ ?>
<?php /*%%SmartyHeaderCode:288775884c14d1c2af8-16696937%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '045727188780aed705d9714c68a1eb5e7fc15155' => 
    array (
      0 => '.\\View\\02.html',
      1 => 1486092254,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '288775884c14d1c2af8-16696937',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5884c14d2d4239_86690421',
  'variables' => 
  array (
    'name' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5884c14d2d4239_86690421')) {function content_5884c14d2d4239_86690421($_smarty_tpl) {?><html>
<head>
<meta charset="utf-8">
</head>
<body>
<h2>保留变量使用</h2>
<div>名字：<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</div>
<div>名字(get传值)：<?php echo $_GET['name'];?>
</div>
<div>主机名：<?php echo @constant('Host');?>
</div>
<div>时间戳：<?php echo time();?>
</div>
<div>当前模板名称：<?php echo basename($_smarty_tpl->source->filepath);?>
</div>
<div>模板目录名称：<?php echo dirname($_smarty_tpl->source->filepath);?>
</div>
<div>模板引擎版本：<?php echo 'Smarty-3.1-DEV';?>
</div>
<div>模板引擎定界符：<?php echo '{';?>
--<?php echo '}';?>
</div>
</body>
</html><?php }} ?>
