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
            <form method="POST" action="index.php?module=employees&view=listView&action=orderBy">
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
