<div class="container">
<div class="jumbotron">
<form method="POST" action="index.php?module=employees&view=EditView&action=save">
    <div class="row">
        {foreach from=$fieldTitles key=idx item=ft}
            <div class="col-xs-4">
            {foreach from=$ft key=name item=title}
             
            {if $fieldTypes[$name] eq 'text'}
                <div class="form-group form-group-sm">
                <label for="{$name}">{$title}</label>
                <input class="form-control" type="text" id="{$name}" name="{$name}" value="">
                </div><!-- form-group -->
            {elseif $fieldTypes[$name] eq 'number'}
                <div class="form-group form-group-sm">
                <label for="{$name}">{$title}</label>
                <input class="form-control" type="text" id="{$name}" name="{$name}" value="">
                </div><!-- form-group -->
            {elseif $fieldTypes[$name] eq 'hidden'}
                <input  type="hidden" name="{$name}" id="{$name}">
            {elseif $fieldTypes[$name] eq 'bool'}
                <div class="form-group form-group-sm">
                <label for="{$name}">{$title}</label>
                <input class="form-control" type="checkbox" id="{$name}" name="{$name}" value="0">
                </div><!-- form-group -->
            {elseif $fieldTypes[$name] eq 'date'}
                <div class="form-group form-group-sm">
                <label for="{$name}">{$title}</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                
                </div><!-- form-group -->
            {elseif is_array($fieldTypes[$name])}
                <div class="form-group form-group-sm">
                <label for="{$name}">{$title}</label>
                <select class="form-control" name='{$name}'>
                    {foreach from=$relatedTables[$name] key=id item=title}
                    <option>{$title['title']}</option>
                    {/foreach}
                </select>
                </div><!-- form-group -->
            {/if}
                
            {/foreach}
            </div><!-- col -->
        {/foreach}
        
        </div><!-- row -->
</form>
        

</div><!--jumbotron -->
</div>  <!-- container -->