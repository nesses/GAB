<div id="employess">
    <div id='title'>
        Mitarbeiter - {$viewTitles[$view]}
    </div>
<div id="inner_mod_error">
{$error}
</div>
<div id="actions_nav">
<table id="actions_nav_table">
    <tr>
        <td><a href="index.php?module=employees&view=createNew">hinzufugen</a></td>
        <td><a href="index.php?module=employees&view=listAll">anzeigen</a></td>
    </tr>
</table>
</div>
{if $view eq "createNew"}
	<form method="POST" action="index.php?module=employees&view=createNew&action=save">
		<table>
                    {foreach from=$fieldTitles key=key item=title}
                            {if $fieldEntities[$key] eq 'hidden'}
                            <input type='hidden' name="{$key}" value=""/>
                            {elseif $fieldEntities[$key] eq "combobox"}
                            {if $key eq 'groups_id'}
                                {$name = $key}
                                {$options = $groups}
                            {elseif $key eq 'rights_id'}
                                {$name = $key}
                                {$options = $rights}
                            {/if}
                            <tr>
                                <td>{$title}:</td>
				<td>{include file="templates/items/combobox.tpl"}</td>
                            </tr>
                            {elseif $fieldEntities[$key] eq "text"}
                            <tr>    
                                <td>{$title}</td>
                                <td><input type="text" name="{$key}"/></td>
                            </tr>
                            {elseif $fieldEntities[$key] eq "password"}
                            <tr>    
                                <td>{$title}</td>
                                <td><input type="password" name="{$key}"/></td>
                            </tr>
                            {/if}
                        
                    {/foreach}
                    <tr>
                        <td>
                            
                        </td>
                        <td>
                            <button type="submit" name="_action" value="">Hinzufügen</button>
                        </td>
                    </tr>
		</table>
                </form>
{elseif $view eq "listAll"}
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
            <td>{include file="templates/items/combobox.tpl"}</td>
        
        </tr>
    </table>
    <table id='listAll'>
        <tr id='listAllTitles'><!-- ONLY COLUMN KEYS -->
            {foreach from=$fieldTitles key=title item=value}
            {if $fieldVisibility[$title] eq 1}
            <form method="POST" action="index.php?module=employees&view=listAll&action=orderBy">
                <td class='listAllTitlesItem'>
                    <button style="background:#006600;color:white;border:none;width:80px;" type="submit" name="action" value="{$title}">{$value}</button>
                </td>
            </form>
            {/if}
            {/foreach}
        </tr>
        {foreach from=$users key=row item=cols}
            <tr id='listAllRowA'>
                {foreach from=$cols key=title item=val}
                    {if $fieldVisibility[$title] eq 1}
                    <td>
                         {$val}
                    </td>
                    {/if}
                {/foreach}
                <td>[E]</td>
                <td>[D]</td>
            </tr>
        {/foreach}
    </table>
    <table style="width: 100%;">
        <tr class="tableCommands">
            <td style="width: 30px;"><---</td>
            <td style="width: 20px;">#::</td>
            <td style="width: 30px;">
                <input type="text" style="width: 30px;" name="pagesize"/>
            </td>
            <td>{include file="templates/items/combobox.tpl"}</td>
            <td style="background: grey;"></td>
            <td style="width: 30px;">---></td>
            <td></td>
        </tr>
    </table>
{/if}

</div>
