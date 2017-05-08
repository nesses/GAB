<table>
    <tr>
        <td>Seite:</td>
        <td><<<</td>
        <td>
            <select>
                {for $i=0 to $pageCount}
                <option onclick="window.location='index.php?module={$module}&view={$view}&page={$i}'">{$i+1}</option>
                {/for}
            </select>
        </td>
        <td>>>></td>
        <td>
            Pro Seite:
        </td>
        <td>
            <select>
                {for $i=1 to 4}
                <option onclick="window.location='index.php?module={$module}&view={$view}&offset={$i*5}'">{$i*5}</option>
                {/for}
            </select>
        </td>
    </tr>
</table>
<table id='listAll'>
    <tr id='listAllTitles'>
        {foreach from=$fieldTitles key=title item=value}
        {if $fieldVisibility[$title] eq 1}
            <td class='listAllTitlesItem'>
                <a href="index.php?module={$module}&view={$view}&orderby={$title}">
                    <button style="background:#006600;color:white;border:none;width:80px;" type="submit" name="action" value="{$title}">
                        {$value}
                    </button>
                </a>
            </td>
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
            <td><a href="index.php?module={$module}&view=EditView&id={$cols['id']}">[E]</a></td>
            <td><a href="index.php?module={$module}&action=delete&id={$cols['id']}">[D]</a></td>
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