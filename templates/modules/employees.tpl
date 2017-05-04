
<div id="actions_nav">
<table id="actions_nav_table">
    <tr>
        <td><a href="index.php?module=employees&view=editView">hinzufugen</a></td>
        <td><a href="index.php?module=employees&view=listView">anzeigen</a></td>
    </tr>
</table>
</div>
{if $view eq "listView"}
{include file="templates/views/listView.tpl"}
{/if}

</div>
