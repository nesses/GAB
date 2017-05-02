<?php
/* Smarty version 3.1.30, created on 2017-04-28 15:57:13
  from "/var/www/gab_/templates/items/rights.combobox.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59034a399291a0_70725957',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8dbc7b72f6a4d62703ee9988c881c2e20a6183bb' => 
    array (
      0 => '/var/www/gab_/templates/items/rights.combobox.tpl',
      1 => 1493387825,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/items/combobox.tpl' => 1,
  ),
),false)) {
function content_59034a399291a0_70725957 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('options', $_smarty_tpl->tpl_vars['rights']->value);
?>  
<?php $_smarty_tpl->_assignInScope('name', "rights_id");
$_smarty_tpl->_subTemplateRender("file:templates/items/combobox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
