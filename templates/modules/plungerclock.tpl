<h1>Anwesende Kollegen</h1> 
<form method="POST" action="index.php?module=plungerclock&action=stamp">
    <table>
        <tr>
            <td>Name:</td>
            <td>Vorname:</td>
        </tr>
        {foreach from=$users key=id item=user}
            <tr>
                <td>{$user['name']}</td>
                <td>{$user['surname']}</td>
            </tr>
        {/foreach}
        <tr>
            <td><input type="submit" value="Stempeln" name="stamp" /></td>
        </tr>
    <table>
</form>
	


</div>