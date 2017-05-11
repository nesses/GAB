<div class="alert alert-{$type}">
  <strong>
    {if $type eq 'success'}
    OK!
    {elseif $type eq 'info'}
    INFO!
    {elseif $type eq 'warning'}
    ACHTUNG!
    {elseif $type eq 'danger'}
    ERROR!
    {/if}
  </strong> {$message}
</div>