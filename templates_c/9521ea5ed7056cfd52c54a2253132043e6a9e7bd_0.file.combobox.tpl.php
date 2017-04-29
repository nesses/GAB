<?php
/* Smarty version 3.1.30, created on 2017-04-28 16:00:56
  from "/var/www/gab_/templates/items/combobox.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59034b189be874_47729481',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9521ea5ed7056cfd52c54a2253132043e6a9e7bd' => 
    array (
      0 => '/var/www/gab_/templates/items/combobox.tpl',
      1 => 1493388053,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59034b189be874_47729481 (Smarty_Internal_Template $_smarty_tpl) {
?>
<select name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['options']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?> 
	<option value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
</option>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</select><?php }
}
