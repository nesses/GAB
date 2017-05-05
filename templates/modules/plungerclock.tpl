<div style="width:100%;">
    

<div style="padding-left:350px;margin:5px;background:white;width:250px;" id="user_info">
    <table style="background:{if $user_work_stat eq '1'}darkgreen{else}red{/if};color:white;width:100%;text-align: center;">
        <tr>
            <td style="font-size: 14px;font-weight: bold">{if $user_work_stat eq '1'}Anwesend{else}Abwesend{/if}<td> 
            
        </tr>
    </table>
</div>  
<div style="float:left;padding:110px;">
</div>
<div style="float:left;margin:5px;background:lightgray;width:250px;min-height:150px;" id="group_members">
    <table style="background:darkgreen;color:white;width:100%;text-align: center;">
        <tr>
            <td style="font-size: 14px;font-weight: bold">Anwesende Kollegen<td> 
        </tr>
    </table>
    <table style="width:100%;background:#efefef;text-align: center;" class="table_controls">
        <tr>
            <td><a href="index.php?module=plungerclock&view=dashBoard&page=0">-<--<</a></td>
            <td>XX/XX</td>
            <td>->--></td>
        </tr>
    </table>
    <table style="width:100%;text-align:center;">
        <tr>
            <th>Vorname</th>
            <th>Nachname</th>
        </tr>
        {foreach from=$users key=id item=itm}
            <tr>
                <td>{$itm['surname']}</td>
                <td>{$itm['name']}</td>
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
<div style="float:left;margin:5px;background:lightgray;width:250px;height:150px;" id="user_info">
    <table style="background:darkgreen;color:white;width:100%;text-align: center;">
        <tr>
            <td style="font-size: 14px;font-weight: bold">{$myself}<td>      
        </tr>
    </table>
    <table>
        <tr>
            <th></th>
            <th>Arbeitszeit<th>
            <th>Pause<th>
        </tr>
        <tr>
            <td>Heute:<td>
            <td><td>
        </tr>
        <tr>
            <td>Diese Woche:<td>
            <td><td>
        </tr>
        <tr>
            <td>Diesen Monat:<td>
            <td><td>
        </tr>
        <tr>
            <td>Letzten Monat:<td>
            <td><td>
        </tr>
    </table>
</div>

</div>