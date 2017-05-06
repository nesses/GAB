<div style="float:left;margin:5px;background:lightgray;width:250px;min-height:150px;" id="group_members">
    <table style="background:darkgreen;color:white;width:100%;text-align: center;">
        <tr>
            <td style="font-size: 14px;font-weight: bold">Anwesende Kollegen<td> 
        </tr>
    </table>
    <table style="width:100%;background:#efefef;text-align: center;" class="table_controls">
        <tr>
            <td><a href="index.php?module=plungerclock&view=dashBoard&page={$prvpage}">-<--<</a></td>
            <td>Seite: {$page}/{$pages}</td>
            <td><a href="index.php?module=plungerclock&view=dashBoard&page={$nxtpage}">->--></a></td>
        </tr>
    </table>
    <table style="width:100%;text-align:center;">
        <tr>
            <th>Vorname</th>
            <th>Nachname</th>
        </tr>
        {foreach from=$buddies key=id item=buddy}
            <tr>
                <td>{$buddy['surname']}</td>
                <td>{$buddy['name']}</td>
            </tr>
        {/foreach}
    </table>    
    <form method="POST" action="index.php?module=plungerclock&view=dashBoard&action=stamp">
        <table style="width:100%;text-align: center;">    
            <tr style="background:gray;">
                <td><input style="background:yellow;font-size:16px;" type="submit" value="{if $user_work_stat eq '1'}Feierabend/Pause{else}Arbeit beginnen{/if}" name="stamp" /></td>
            </tr>
        </table>
    </form>	
</div>