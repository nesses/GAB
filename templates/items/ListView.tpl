    <table style="width:100%;">
    <tr>
        <td>Seite:</td>
        <td><<<</td>
        <td>
            <select>
                {if $pageCount > 0}
                {for $i=1 to $pageCount}
                <option {if $page eq $i}selected{/if} onclick="window.location='index.php?module={$module}&view=ListView&page={$i}'">{$i}</option>
                {/for}
                {else}
                    <option>1</option>
                {/if}
            </select> <b>/ {$pageCount+1}</b>
        </td>
        <td>>>></td>
        <td>
            Pro Seite:
        </td>
        <td>
            <select>
                {for $i=1 to 4}
                <option {if $i*5 eq $offset}selected{/if} onclick="window.location='index.php?module={$module}&view=ListView&offset={$i*5}'">{$i*5}</option>
                {/for}
            </select>
        </td>
        <td style="width:50%;"></td>
        <td>
            <a href="index.php?view=EditView&mode=new">Mitarbeiter hinzufügen</a>
        </td>
        
    </tr>
</table>
<table style="width:100%;" id='listAll'>
    <tr id='listAllTitles'>
        {foreach from=$fieldTitles key=title item=value}
        {if $fieldVisibility[$title] eq 1}
            <td class='listAllTitlesItem'>
                <a href="index.php?module={$module}&view=ListView&orderby={$title}">
                    <button style="background:#006600;color:white;border:none;width:80px;" type="submit" name="action" value="{$title}">
                        {$value}
                    </button>
                </a>
            </td>
        {/if}
        {/foreach}
    </tr>
    {foreach from=$content key=row item=cols}
        <tr id='listAllRowA'>
            {foreach from=$fieldVisibility key=col item=visibility}
                {if $visibility eq 1}
                <td>
                     {$content[$row][$col]}
                </td>
                {/if}
            {/foreach}
            <td><a href="index.php?module={$module}&view=EditView&id={$cols['id']}">[E]</a></td>
            <td><a href="index.php?module={$module}&view=EditView&action=delete&id={$cols['id']}">[D]</a></td>
        </tr>
    {/foreach}
    <tr id='listAllTitles'>
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