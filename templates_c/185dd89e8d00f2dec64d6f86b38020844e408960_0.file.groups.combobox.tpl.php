<?php
/* Smarty version 3.1.30, created on 2017-04-28 15:57:13
  from "/var/www/gab_/templates/items/groups.combobox.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59034a396b2844_22625474',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '185dd89e8d00f2dec64d6f86b38020844e408960' => 
    array (
      0 => '/var/www/gab_/templates/items/groups.combobox.tpl',
      1 => 1493387819,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/items/combobox.tpl' => 1,
  ),
),false)) {
function content_59034a396b2844_22625474 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('options', $_smarty_tpl->tpl_vars['groups']->value);
?>  
<?php $_smarty_tpl->_assignInScope('name', "groups_id");
$_smarty_tpl->_subTemplateRender("file:templates/items/combobox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
