  
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
    </table>