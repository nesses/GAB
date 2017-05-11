
<div class="container">
<div class="jumbotron">
    <div class="alert alert-{$type}">
      <strong>
        {if $type eq 'success'}
        OK!
        {elseif $type eq 'info'}
        INFO!
        {elseif $type eq 'warning'}
        ACHTUNG!
        {elseif $type eq 'danger'}
        FEHLER!
        {/if}
      </strong> {$message}
    </div>
</div>
    </div>