<?php
/* Smarty version 3.1.30, created on 2017-04-29 20:06:14
  from "/var/www/gab_/templates/navigation.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5904d616841406_02768603',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4267c3bbaadd24d0851260929c36e1ab0b9cda96' => 
    array (
      0 => '/var/www/gab_/templates/navigation.tpl',
      1 => 1493489172,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/content.tpl' => 1,
  ),
),false)) {
function content_5904d616841406_02768603 (Smarty_Internal_Template $_smarty_tpl) {
?>
        <div id="navigation">
            <img src="img/logoGab.png" id="simple_nav_logo" alt="logo"></img>
            <table cellpadding="0" cellspacing="0" class="horizontal_nav">
                <tr>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['modules']->value, 'id', false, 'title');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['title']->value => $_smarty_tpl->tpl_vars['id']->value) {
?>
                    <td class="nav_item"><a href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
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
