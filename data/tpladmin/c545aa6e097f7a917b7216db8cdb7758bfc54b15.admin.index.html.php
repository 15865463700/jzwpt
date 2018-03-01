<?php /* Smarty version Smarty-3.1.8, created on 2017-03-09 09:35:38
         compiled from "admin:tools/cache/index.html" */ ?>
<?php /*%%SmartyHeaderCode:190976432558c0b16a9bf744-54917325%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c545aa6e097f7a917b7216db8cdb7758bfc54b15' => 
    array (
      0 => 'admin:tools/cache/index.html',
      1 => 1415935606,
      2 => 'admin',
    ),
  ),
  'nocache_hash' => '190976432558c0b16a9bf744-54917325',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pager' => 0,
    'MOD' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_58c0b16a9fb8a9_69926341',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58c0b16a9fb8a9_69926341')) {function content_58c0b16a9fb8a9_69926341($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("admin:common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="page-title">
    <table width="100%" align="center" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="30" align="right"><img src="<?php echo $_smarty_tpl->tpl_vars['pager']->value['url'];?>
/images/main-h5-ico.gif" alt="" /></td>
        <th><?php echo $_smarty_tpl->tpl_vars['MOD']->value['title'];?>
</th>
        <td align="right"></td>
        <td width="15"></td>
      </tr>
    </table>
</div>
<div class="page-data">
<h4 class="tip-notice">清空缓存后，刚开始网站会有些慢，随后就会恢复正常</h4>
<form action="?tools/cache-clean.html" mini-form="config-form" method="post" >
<table width="100%" border="0" cellspacing="0" class="table-data form">
<tr><th style="height:40px;">选择清空的缓存：</th>
    <td>
    <ul class="group-list">
        <li><label><input type="checkbox" name="cache_data" value="1" checked="checked"/>数据缓存</label></li>
        <li><label><input type="checkbox" name="cache_tplcache" value="1" />前台模板缓存</label></li>
        <li><label><input type="checkbox" name="cache_tpladmin" value="1" />后台模板缓存</label></li>
    </ul>
</td>
<tr><th class="clear-th-bottom"></th><td class="clear-td-bottom" colspan="10"><input type="submit" class="bt-big" value="提交数据" /></td></tr>
</table>
</form>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("admin:common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>