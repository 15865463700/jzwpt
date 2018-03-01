<?php /* Smarty version Smarty-3.1.8, created on 2017-03-05 16:00:02
         compiled from "widget:default/option.html" */ ?>
<?php /*%%SmartyHeaderCode:132534739458bbc58206e3a2-96583539%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8618e56743956cdad3a83610664518f0a76ab02' => 
    array (
      0 => 'widget:default/option.html',
      1 => 1419216078,
      2 => 'widget',
    ),
  ),
  'nocache_hash' => '132534739458bbc58206e3a2-96583539',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'detail' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_58bbc58207a749_11700340',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58bbc58207a749_11700340')) {function content_58bbc58207a749_11700340($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/www/web/850196412_ijianghu_net/public_html/system/libs/smarty/plugins/function.html_options.php';
?><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['data']->value['options'],'selected'=>$_smarty_tpl->tpl_vars['data']->value['value'],'value'=>$_smarty_tpl->tpl_vars['detail']->value['value']),$_smarty_tpl);?>
<?php }} ?>