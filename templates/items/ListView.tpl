<div class="container jumbotron"> 
<div class="container">    
<table class="table table-striped">
    <thead>
        <tr>
        {foreach from=$fieldTitles key=title item=value}
        {if $fieldVisibility[$title] eq 1}
            <th>
                <a href="index.php?module={$module}&view=ListView&orderby={$title}">
                {$value}
                </a>
            </th>
        {/if}
        {/foreach}
        </tr>
    </thead>
    <tbody>          
    {foreach from=$content key=row item=cols}
        <tr>
        {foreach from=$fieldVisibility key=col item=visibility}
        {if $visibility eq 1}
            <td>
                {$content[$row][$col]}
            </td>
        {/if}
        {/foreach}
            <td><a href="index.php?module={$module}&view=EditView&id={$cols['id']}">[E]</a></td>
            <td><a href="index.php?module={$module}&view=EditView&action=delete&id={$cols['id']}">[D]</a></td>
        </tr>
    {/foreach}
    </tbody>
</table>
    <a href="index.php?view=EditView"><button type="submit" class="btn btn-success">Mitarbeiter erstellen</button></a>    
</div><!-- jumbotron -->
</div><!-- container -->
      