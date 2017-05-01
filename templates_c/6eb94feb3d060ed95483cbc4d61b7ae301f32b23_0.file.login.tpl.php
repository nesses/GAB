<?php
/* Smarty version 3.1.30, created on 2017-05-01 21:52:54
  from "/var/www/gab_/templates/modules/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_590792162ca8f6_84370094',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6eb94feb3d060ed95483cbc4d61b7ae301f32b23' => 
    array (
      0 => '/var/www/gab_/templates/modules/login.tpl',
      1 => 1493668372,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_590792162ca8f6_84370094 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="inner_mod_error">
<?php echo $_smarty_tpl->tpl_vars['error']->value;?>

</div>
<div id='login'>


<div id="login_form"> 
    <form name="f1" method="post" style="color:white;" action="index.php?module=login&action=doLogin" id="f1">
        <table>
            <tr>
               <td class="f1_label">Benutzername :</td>
               <td><input type="text" name="username" value="" /> </td>
            </tr> 
            <tr>
               <td class="f1_label">Passwort :</td>
               <td><input type="password" name="password" value="" /> </td> 
            </tr> 
            <tr> <td></td>
                <td><input type="submit" name="login" value="Log In" style="width:100px;" /> </td>
            </tr>
        </table>
    </form> 
    </div>

</div><?php }
}
