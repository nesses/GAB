<!--
@param $atWork boolean 
-->
<div style="float:left;margin:5px;background:lightgray;width:250px;" id="group_members">
    <table style="background:{if $status eq '1'}darkgreen{else}red{/if};color:white;width:100%;text-align: center;">
        <tr>
            <td style="font-size: 14px;font-weight: bold">{if $status eq '1'}Anwesend{else}Abwesend{/if}<td> 
            
        </tr>
    </table>
    <table style="width:100%;background:#efefef;text-align: center;" class="table_controls">
        <tr>
            <td><a href="index.php?module=plungerclock&view=dashBoard&day=back">-<--<</a></td>
            <td>{date('d.m.Y')}</td>
            <td><a href="index.php?module=plungerclock&view=dashBoard&day=next">->--></a></td>
        </tr>
    </table>
    <table style="width:100%;text-align: center;">
        <tr>
            <th>Angemelet</th>
            <th>Abgemeldet</th>
            <th>Dauer</th>
        </tr>
        {foreach from=$commingstamps key=idx item=val}
            <tr>
                <td>{date('H:i',strtotime($commingstamps[$idx]['timestamp']))}</td>
                <td>{if $goingstamps[$idx]['timestamp']}{date('H:i',strtotime($goingstamps[$idx]['timestamp']))}{/if}</td>
                <td>{$times[$idx]}</td>
            </tr>
        {/foreach}
            <tr>
                <td></td>
                <td style="font-weight:bold;">Std.Heute:</td>
                <td>{$summary}</td>
            </tr>
    </table>
    {if $forgetInfo eq 'enabled'}
    <table style="background:red;color:white;width:100%;text-align: center;">
        <tr>
            <td style="font-size: 14px;font-weight: bold">Gestern vergessen abzumelden?<td> 
            
        </tr>
    </table>    
    {/if}
    {if $stampButton eq 'enabled'}    
    <form method="POST" action="index.php?module=plungerclock&view=dashBoard&action=stamp{if $forgetInfo eq 'enabled'}forget{/if}">
        <table style="width:250px;text-align:center" border="0">    
            <tr>
                <td><input style="background:yellow;font-size:16px;" type="submit" value="{if $forgetInfo eq 'enabled'}Gestern Abmelden{else}{if $status eq '1'}Feierabend/Pause{else}Arbeit beginnen{/if}{/if}" name="stamp" /></td>
            </tr>
        </table>
    </form>
    {/if}
</div>  