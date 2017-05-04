{include file="templates/items/viewsNav.tpl"}
{if $view eq "listView"}
    {include file="templates/views/listView.tpl"}
{elseif $view eq "editView"}
    {include file="templates/views/editView.tpl"}
{/if}
</div>