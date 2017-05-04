 <!-- 
    @author:    Matthias Grotjohann
-->
<!DOCTYPE html>
<html>
    <head>
        <title>[GAB] - {$modTitles[$module]}  </title>
        <link rel="shortcut icon" href=""> 
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="css/layout.css">
    </head>
    <body>
        <script type="text/javascript" src="js/functions.js"></script>
        
        <div id="header">
        </div>
  
        <div id="navigation">
            <img src="img/logoGab.png" id="simple_nav_logo" alt="logo"></img>
            <table cellpadding="0" cellspacing="0" class="horizontal_nav">
                <tr>
                    {foreach from=$modTitles key=name item=title}
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
        <div id="content">
            <div id="{$modTitles[$module]}">
                <div id='title'>
                    {$modTitles[$module]}
                </div>



