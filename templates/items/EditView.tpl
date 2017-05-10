<div style="background:white;width:100%;height:100%;">
    <table style="border:1px solid;">
        {foreach from=$fieldTitles key=name item=title}
        {if $fieldTypes[$name] neq ''}
        <tr>
            <td>
                {$title}
            </td>
            <td>
            {if $fieldTypes[$name] eq 'text'}
                {$title}
            {else}
            Typ nicht definiert
            {/if}
            </td>
        </tr>
        {/if}
        {/foreach}
    </table>
</div>