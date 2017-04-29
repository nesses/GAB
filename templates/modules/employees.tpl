<div id="employess">
    <div id='title'>
        Mitarbeiter
    </div>
<div id="inner_mod_error">
{$error}
</div>
<div id="actions_nav">
<table id="actions_nav_table">
    <tr>
        <td><a href="index.php?module=employees&view=createNew">hinzufugen</a></td>
        <td><a href="index.php?module=employees&view=listAll&orderby=id">anzeigen</a></td>
    </tr>
</table>
</div>
{if $view eq "createNew"}
	<form method="POST" action="index.php?module=employees&view=createNew&action=save">
		<table>
                    {foreach from=$colTitles key=key item=title}
                        
                            {if $key eq "group_id"}
                            <tr>
                                <td>{$title}:</td>
				<td>{include file="templates/items/groups.combobox.tpl"}</td>
                            </tr>
                            {elseif $key eq "status"}
                                <input type="hidden" name="status" value="0"/>
                            
                            {elseif $key eq "rights_id"}
                            <tr>
                                <td>{$title}:</td>
                                <td>{include file="templates/items/rights.combobox.tpl"}</td>
                            </tr>
                            {elseif $key eq "created"}
                                <input type="hidden" name="created" value="TIMESTAMP"/>
                            {elseif $key eq "creator_id"}
                                <input type="hidden" name="creator_id" value="{$uid}"/>
                            {elseif $key eq "alterer_id"}
                                <input type="hidden" name="{$key}" value="{$uid}"/>
                            {else}
                            <tr>    
                                <td>{$title}</td>
                                <td><input type="text" name="{$key}"/></td>
                            </tr>
                            {/if}
                        
                    {/foreach}
                    <tr>
                        <td>
                            
                        </td>
                        <td>
                            <button type="submit" name="action" value="0">Hinzufügen</button>
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
            {foreach from=$colTitles key=title item=value}
                {if $fields[$title] eq 'int'}
            <td class='listAllTitlesItem'>
                <!-- <a href="index.php?module=employees&view=listAll&orderby</a> -->
                <form method="POST" action="index.php">
                    <button style="border:1px solid;width:30px;" type="submit" name="action" value="orderby">{$value}</button>
                </form>
            </td>
            {else}
                <td class='listAllTitlesItem'>
                <!-- <a href="index.php?module=employees&view=listAll&orderby</a> -->
                <form method="POST" action="index.php">
                    <button style="border:1px solid;width:80px;" type="submit" name="action" value="orderby">{$value}</button>
                </form>
            </td>
            {/if}
            {/foreach}
        </tr>
        {foreach from=$users key=row item=cols}
            <tr id='listAllRowA'>
                {foreach from=$cols key=title item=val}
                    {if $title eq "rights_id"}
                        <td>{$rights[$val]['title']}</td>
                    {elseif $title eq "password"}
                        <td>********</td>
                    {elseif $title eq "creator_id"}
                        <td>{$users[$val]['surname']}</td>
                    {elseif $title eq "group_id"}
                        <td>{$groups[$val]['title']}</td>
                    {elseif $title eq "alterer_id"}
                        <td>{$users[$val]['surname']}</td>
                    {elseif $title eq "created"}
                        <td>{gmdate("d.m.Y", $val)}</td>
                    {elseif $title eq "status"}
                        <td>{if $val eq 1}Online{else}Offline{/if}</td>
                    {else}    
                         <td>{$val}</td>
                {/if}
                {/foreach}
                <td>Bearbeiten</td>
                <td>Löschen</td>
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
