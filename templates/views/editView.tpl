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