<!--
@param $atWork boolean 
-->
<div style="padding-left:350px;margin:5px;background:white;width:250px;" id="user_info">
    <table style="background:{if $atWork eq '1'}darkgreen{else}red{/if};color:white;width:100%;text-align: center;">
        <tr>
            <td style="font-size: 14px;font-weight: bold">{if $atWork eq '1'}Anwesend{else}Abwesend{/if}<td> 
            
        </tr>
    </table>
</div>  