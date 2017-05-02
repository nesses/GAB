<?php
/* Smarty version 3.1.30, created on 2017-05-01 18:51:19
  from "/var/www/gab_/templates/modules/employees.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59076787ebc847_48914555',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '855bbbff510898f3297106389174ef3b40702e17' => 
    array (
      0 => '/var/www/gab_/templates/modules/employees.tpl',
      1 => 1493657475,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/items/combobox.tpl' => 3,
  ),
),false)) {
function content_59076787ebc847_48914555 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="employess">
    <div id='title'>
        Mitarbeiter - <?php echo $_smarty_tpl->tpl_vars['viewTitles']->value[$_smarty_tpl->tpl_vars['view']->value];?>

    </div>
<div id="inner_mod_error">
<?php echo $_smarty_tpl->tpl_vars['error']->value;?>

</div>
<div id="actions_nav">
<table id="actions_nav_table">
    <tr>
        <td><a href="index.php?module=employees&view=createNew">hinzufugen</a></td>
        <td><a href="index.php?module=employees&view=listAll">anzeigen</a></td>
    </tr>
</table>
</div>
<?php if ($_smarty_tpl->tpl_vars['view']->value == "createNew") {?>
	<form method="POST" action="index.php?module=employees&view=createNew&action=save">
		<table>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fieldTitles']->value, 'title', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['title']->value) {
?>
                            <?php if ($_smarty_tpl->tpl_vars['fieldEntities']->value[$_smarty_tpl->tpl_vars['key']->value] == 'hidden') {?>
                            <input type='hidden' name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" value=""/>
                            <?php } elseif ($_smarty_tpl->tpl_vars['fieldEntities']->value[$_smarty_tpl->tpl_vars['key']->value] == "combobox") {?>
                            <?php if ($_smarty_tpl->tpl_vars['key']->value == 'groups_id') {?>
                                <?php $_smarty_tpl->_assignInScope('name', $_smarty_tpl->tpl_vars['key']->value);
?>
                                <?php $_smarty_tpl->_assignInScope('options', $_smarty_tpl->tpl_vars['groups']->value);
?>
                            <?php } elseif ($_smarty_tpl->tpl_vars['key']->value == 'rights_id') {?>
                                <?php $_smarty_tpl->_assignInScope('name', $_smarty_tpl->tpl_vars['key']->value);
?>
                                <?php $_smarty_tpl->_assignInScope('options', $_smarty_tpl->tpl_vars['rights']->value);
?>
                            <?php }?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
:</td>
				<td><?php $_smarty_tpl->_subTemplateRender("file:templates/items/combobox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</td>
                            </tr>
                            <?php } elseif ($_smarty_tpl->tpl_vars['fieldEntities']->value[$_smarty_tpl->tpl_vars['key']->value] == "text") {?>
                            <tr>    
                                <td><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</td>
                                <td><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"/></td>
                            </tr>
                            <?php } elseif ($_smarty_tpl->tpl_vars['fieldEntities']->value[$_smarty_tpl->tpl_vars['key']->value] == "password") {?>
                            <tr>    
                                <td><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</td>
                                <td><input type="password" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"/></td>
                            </tr>
                            <?php }?>
                        
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    <tr>
                        <td>
                            
                        </td>
                        <td>
                            <button type="submit" name="_action" value="">Hinzufügen</button>
                        </td>
                    </tr>
		</table>
                </form>
<?php } elseif ($_smarty_tpl->tpl_vars['view']->value == "listAll") {?>
    <table style="width: 100%;">
        <tr class="tableCommands">
            <td style="width: 30px;">---></td>
            <td style="width: 30px;"><---</td>
            <td style="width: 20px;">
                #::
            </td>
            <td style="width: 30px;">
                <input type="text" style="width: 30px;" name="pagesize"/>
            </td>
            <td><?php $_smarty_tpl->_subTemplateRender("file:templates/items/combobox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</td>
        
        </tr>
    </table>
    <table id='listAll'>
        <tr id='listAllTitles'><!-- ONLY COLUMN KEYS -->
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fieldTitles']->value, 'value', false, 'title');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['title']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
            <?php if ($_smarty_tpl->tpl_vars['fieldVisibility']->value[$_smarty_tpl->tpl_vars['title']->value] == 1) {?>
            <form method="POST" action="index.php?module=employees&view=listAll&action=orderBy">
                <td class='listAllTitlesItem'>
                    <button style="background:#006600;color:white;border:none;width:80px;" type="submit" name="action" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</button>
                </td>
            </form>
            <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </tr>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'cols', false, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value => $_smarty_tpl->tpl_vars['cols']->value) {
?>
            <tr id='listAllRowA'>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cols']->value, 'val', false, 'title');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['title']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
                    <?php if ($_smarty_tpl->tpl_vars['fieldVisibility']->value[$_smarty_tpl->tpl_vars['title']->value] == 1) {?>
                    <td>
                         <?php echo $_smarty_tpl->tpl_vars['val']->value;?>

                    </td>
                    <?php }?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                <td>[E]</td>
                <td>[D]</td>
            </tr>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </table>
    <table style="width: 100%;">
        <tr class="tableCommands">
            <td style="width: 30px;"><---</td>
            <td style="width: 20px;">#::</td>
            <td style="width: 30px;">
                <input type="text" style="width: 30px;" name="pagesize"/>
            </td>
            <td><?php $_smarty_tpl->_subTemplateRender("file:templates/items/combobox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</td>
            <td style="background: grey;"></td>
            <td style="width: 30px;">---></td>
            <td></td>
        </tr>
    </table>
<?php }?>

</div>
<?php }
}
