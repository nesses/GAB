    {include file="templates/error.tpl"}

<div id='login'>


<div id="login_form"> 
    <form id="loginForm" name="f1" method="post" style="color:white;" action="index.php?module=login&view=main&action=doLogin" id="f1">
        <table>
            <tr>
               <td class="f1_label">Benutzername:</td>
               <td><input onchange="verifyUsernamef();" type="text" name="username" value="" /> </td>
            </tr> 
            <tr>
               <td class="f1_label">Passwort :</td>
               <td><input type="password" name="password" value="" /> </td> 
            </tr> 
            <tr> <td></td>
                <td><input type="submit" name="login" value="Log In" style="width:100px;" /> </td>
            </tr>
        </table>
    </form> 
    </div>
</div>
