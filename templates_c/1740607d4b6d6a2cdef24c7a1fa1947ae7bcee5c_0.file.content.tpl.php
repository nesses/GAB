<?php
/* Smarty version 3.1.30, created on 2017-04-28 16:48:47
  from "/var/www/gab_/templates/content.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5903564fd6f881_97959440',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1740607d4b6d6a2cdef24c7a1fa1947ae7bcee5c' => 
    array (
      0 => '/var/www/gab_/templates/content.tpl',
      1 => 1493390925,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5903564fd6f881_97959440 (Smarty_Internal_Template $_smarty_tpl) {
?>
        <div id="content">
<!--
            <div id="left">
       <?php if ($_smarty_tpl->tpl_vars['user']->value['status'] == 1) {?>
                <table class="nav_vertical" cellpadding="0" cellspacing="0">
                   <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['modules']->value, 'id', false, 'title');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['title']->value => $_smarty_tpl->tpl_vars['id']->value) {
?>
                        <?php if ($_smarty_tpl->tpl_vars['id']->value != 'login') {?>
                        <tr>
                            <td class="nav_item nav_item_vert"><a href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</a></td>
                        </tr>
                        <?php }?>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

  	            <tr>
                        <td class="nav_item nav_item_vert"><a href='index.php?module=login&action=doLogout'><img style="background: black;" src="img/ehrenamt.png" widht="20px" height="20px" /><br>Logout</a></td>
                    </tr>             
                </table>
        <?php }?>                
                <div id="home_logo"></div>
            </div>	
--><?php }
}
