<select name="{$name}">
{foreach from=$options key=key item=value} 
	<option value="{$value['id']}">{$value['title']}</option>
{/foreach}
</select>