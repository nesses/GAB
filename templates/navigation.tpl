        <div id="navigation">
            <img src="img/logoGab.png" id="simple_nav_logo" alt="logo"></img>
            <table cellpadding="0" cellspacing="0" class="horizontal_nav">
                <tr>
                    {foreach from=$modules key=id item=title}
                    <td class="nav_item"><a href="index.php?module={$title['name']}">{$title['title']}</a></td>
                    {/foreach}
                    {if $user['username']}
                    <td class="nav_item"><a href="index.php?module=login&action=doLogout">Logout - {$user['username']}</a></td>
                    {/if}
                </tr>
            </table>
        </div>
        <div id="line"></div>   
{include file="templates/content.tpl"}



