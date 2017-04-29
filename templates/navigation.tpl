        <div id="navigation">
            <img src="img/logoGab.png" id="simple_nav_logo" alt="logo"></img>
            <table cellpadding="0" cellspacing="0" class="horizontal_nav">
                <tr>
                    {foreach from=$modules key=title item=id}
                    <td class="nav_item"><a href="index.php?module={$id}">{$title}</a></td>
                    {/foreach}
                    {if $user['status'] eq 1}
                    <td class="nav_item"><a href="index.php?module=login&action=doLogout">Logout</a></td>
                    {/if}
                </tr>
            </table>
        </div>
        <div id="line"></div>   
{include file="templates/content.tpl"}



