<?php
/* Smarty version 3.1.30, created on 2017-04-29 20:09:17
  from "/var/www/gab_/templates/modules/employees.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5904d6cdef6b74_54065778',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '855bbbff510898f3297106389174ef3b40702e17' => 
    array (
      0 => '/var/www/gab_/templates/modules/employees.tpl',
      1 => 1493489356,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/items/groups.combobox.tpl' => 1,
    'file:templates/items/rights.combobox.tpl' => 1,
    'file:templates/items/combobox.tpl' => 2,
  ),
),false)) {
function content_5904d6cdef6b74_54065778 (Smarty_Internal_Template $_smarty_tpl) {
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
                        
                            <?php if ($_smarty_tpl->tpl_vars['key']->value == "group_id") {?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
:</td>
				<td><?php $_smarty_tpl->_subTemplateRender("file:templates/items/groups.combobox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</td>
                            </tr>
                            <?php } elseif ($_smarty_tpl->tpl_vars['key']->value == "status") {?>
                                <input type="hidden" name="status" value="0"/>
                            
                            <?php } elseif ($_smarty_tpl->tpl_vars['key']->value == "rights_id") {?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
:</td>
                                <td><?php $_smarty_tpl->_subTemplateRender("file:templates/items/rights.combobox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</td>
                            </tr>
                            <?php } elseif ($_smarty_tpl->tpl_vars['key']->value == "created") {?>
                                <input type="hidden" name="created" value="TIMESTAMP"/>
                            <?php } elseif ($_smarty_tpl->tpl_vars['key']->value == "creator_id") {?>
                                <input type="hidden" name="creator_id" value="<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
"/>
                            <?php } elseif ($_smarty_tpl->tpl_vars['key']->value == "alterer_id") {?>
                                <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
"/>
                            <?php } else { ?>
                            <tr>    
                                <td><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</td>
                                <td><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
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
                            <button type="submit" name="action" value="0">Hinzufügen</button>
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
            <td><?php $_smarty_tpl->_subTemplateRender("file:templates/items/combobox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
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
