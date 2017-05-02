        <div id="navigation">
            <img src="img/logoGab.png" id="simple_nav_logo" alt="logo"></img>
            <table cellpadding="0" cellspacing="0" class="horizontal_nav">
                <tr>
                    {foreach from=$modules key=name item=title}
                    {if $name neq 'login'}
                    <td class="nav_item"><a href="index.php?module={$name}">{$title}</a></td>
                    {/if}
                    {/foreach}
                    {if $user['username']}
                    <td class="nav_item"><a href="index.php?module=login&action=doLogout">Logout - {$user['username']}</a></td>
                    {else}
                    <td class="nav_item"><a href="index.php?module=login">Login</a></td>
                    {/if}
                </tr>
            </table>
        </div>
        <div id="line"></div>   
{include file="templates/content.tpl"}



