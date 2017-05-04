<div id="actions_nav">
    <table id="actions_nav_table">
        <tr>
            {foreach from=$views key=title item=name}
            <td><a href="index.php?module={$module}&view={$title}">{$name}</a></td>
            {/foreach}
        </tr>
    </table>
</div>