<?php
/* Smarty version 3.1.30, created on 2017-05-01 03:06:06
  from "/var/www/gab_/templates/navigation.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_590689fe6fd742_02974499',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4267c3bbaadd24d0851260929c36e1ab0b9cda96' => 
    array (
      0 => '/var/www/gab_/templates/navigation.tpl',
      1 => 1493600761,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/content.tpl' => 1,
  ),
),false)) {
function content_590689fe6fd742_02974499 (Smarty_Internal_Template $_smarty_tpl) {
?>
        <div id="navigation">
            <img src="img/logoGab.png" id="simple_nav_logo" alt="logo"></img>
            <table cellpadding="0" cellspacing="0" class="horizontal_nav">
                <tr>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['modules']->value, 'title', false, 'id');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['title']->value) {
?>
                    <td class="nav_item"><a href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['title']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['title']->value['title'];?>
</a></td>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    <?php if ($_smarty_tpl->tpl_vars['user']->value['userstatus_id'] == 1) {?>
                    <td class="nav_item"><a href="index.php?module=login&action=doLogout">Logout</a></td>
                    <?php }?>
                </tr>
            </table>
        </div>
        <div id="line"></div>   
<?php $_smarty_tpl->_subTemplateRender("file:templates/content.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>




<?php }
}
