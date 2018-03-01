<?php /* Smarty version Smarty-3.1.8, created on 2017-03-05 16:00:01
         compiled from "admin:block/item/create.html" */ ?>
<?php /*%%SmartyHeaderCode:130313850158bbc581f29eb8-67785804%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5cb40dc4051054a1b4b21618b1e190f8e0784bba' => 
    array (
      0 => 'admin:block/item/create.html',
      1 => 1415935612,
      2 => 'admin',
    ),
  ),
  'nocache_hash' => '130313850158bbc581f29eb8-67785804',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pager' => 0,
    'MOD' => 0,
    'detail' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_58bbc582059cf0_31304112',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58bbc582059cf0_31304112')) {function content_58bbc582059cf0_31304112($_smarty_tpl) {?><?php if (!is_callable('smarty_function_link')) include '/www/web/850196412_ijianghu_net/public_html/system/plugins/smarty/function.link.php';
if (!is_callable('smarty_function_widget')) include '/www/web/850196412_ijianghu_net/public_html/system/plugins/smarty/function.widget.php';
?><?php echo $_smarty_tpl->getSubTemplate ("admin:common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page-title">
    <table width="100%" align="center" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="30" align="right"><img src="<?php echo $_smarty_tpl->tpl_vars['pager']->value['url'];?>
/images/main-h5-ico.gif" alt="" /></td>
        <th><?php echo $_smarty_tpl->tpl_vars['MOD']->value['title'];?>
</th>
        <td align="right"><?php echo smarty_function_link(array('ctl'=>"block/item:index",'priv'=>"hidden",'class'=>"button"),$_smarty_tpl);?>
</td>
        <td width="15"></td>
      </tr>
    </table>
</div>
<div class="page-data">
<form action="?block/item-create.html" mini-form="item-form" method="post" ENCTYPE="multipart/form-data">
<input type="hidden" name="itemId" value="<?php echo $_smarty_tpl->tpl_vars['pager']->value['itemId'];?>
" />
<input type="hidden" name="from" value="<?php echo $_smarty_tpl->tpl_vars['pager']->value['from'];?>
" />
<table width="100%" border="0" cellspacing="0" class="table-data form">
<tr><th>推荐位：</th><td><select name="data[block_id]" class="w-200"><?php echo smarty_function_widget(array('id'=>"block/option",'from'=>$_smarty_tpl->tpl_vars['pager']->value['from']),$_smarty_tpl);?>
</select></td></tr>
<tr><th>城市：</th><td><?php echo smarty_function_widget(array('id'=>"data/city",'type'=>"checkbox",'name'=>"data[city_ids]",'value'=>$_smarty_tpl->tpl_vars['detail']->value['city_ids']),$_smarty_tpl);?>
</td></tr>
<tr><th>标题：</th><td><input type="text" name="data[title]" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['title'])===null||$tmp==='' ? '' : $tmp);?>
" class="input w-300"/></td></tr>
<tr><th>连接：</th><td><input type="text" name="data[link]" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['link'])===null||$tmp==='' ? '' : $tmp);?>
" class="input w-300"/></td></tr>
<tr>
	<th>图片：</th>
	<td>
		<input type="text" name="data[thumb]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['thumb'];?>
" class="input w-200" <?php if ($_smarty_tpl->tpl_vars['item']->value['thumb']){?>photo="<?php echo $_smarty_tpl->tpl_vars['pager']->value['img'];?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['thumb'];?>
<?php if (!isset($_smarty_tpl->tpl_vars['pager']) || !is_array($_smarty_tpl->tpl_vars['pager']->value)) $_smarty_tpl->createLocalArrayVariable('pager');
if ($_smarty_tpl->tpl_vars['pager']->value['from'] = 'taoke'){?>_400x400.jpg<?php }?>"<?php }?>/>&nbsp;&nbsp;&nbsp;
		<input type="file" name="data[thumb]" class="input w-100" />
	</td>
</tr>
<tr><th>有效期：</th><td><input type="text" name="data[expire_time]" class="input w-100" date="expire_time" value="0"/><span class="tip-comment">0：永不过期</span></td></tr>
<tr><th>排序：</th><td><input type="text" name="data[orderby]" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['detail']->value['orderby'])===null||$tmp==='' ? '50' : $tmp);?>
" class="input w-100"/></td></tr>
<tr><th class="clear-th-bottom"></th><td class="clear-td-bottom" colspan="10"><input type="submit" class="bt-big" value="提交数据" /></td></tr>
</table>
</form></div>
<?php echo $_smarty_tpl->getSubTemplate ("admin:common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>