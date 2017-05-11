<div class="container jumbotron">
<div class="container">
<form style="" method="POST" action="index.php?module=employees&view=EditView&action=save">
    <table>
        <tr>
            <td><button type="submit" action="save">Speichern</button></td>
        </tr>
    </table>
    <table>
        
        {foreach from=$fieldTitles key=idx item=ft}
           
        <tr>
            {foreach from=$ft key=name item=title}
            <td>
                <b>{$title}<b>
            </td>
            <td>
            {if $fieldTypes[$name] eq 'text'}
                <input type="text" name="{$name}" value=""/>
            {elseif $fieldTypes[$name] eq 'number'}
                <input type="text" name="{$name}" value=""/>
            {elseif $fieldTypes[$name] eq 'hidden'}
                ---
            {elseif $fieldTypes[$name] eq 'bool'}
                <input type="checkbox"  name="{$name}" value="0">
            {elseif $fieldTypes[$name] eq 'date'}
                <select>
                    <option>tag</option>
                    {for $i=1 to 31}
                    <option>{$i}</option>
                    {/for}
                </select>
                <select style="">
                    <option>Monat</option>
                    {for $i=1 to 12}
                    <option>{$i}</option>
                    {/for}
                </select>
                <select>
                    <option>2017</option>
                    {for $i=2013 to 2030}
                    <option>{$i}</option>
                    {/for}
                </select>
            {elseif is_array($fieldTypes[$name])}
                <select name='{$name}'>
                    {foreach from=$relatedTables[$name] key=id item=title}
                    <option>{$title['title']}</option>
                    {/foreach}
                </select>
            {/if}
            </td>
            {/foreach}
        </tr>
        
        {/foreach}
        
    </table>
</form>
</div>