<form method="POST">
<input type="hidden" name="x{$BASEID}_action" />
<input type="submit" value="{$LABEL_SUBMIT}" name="submit" class="button" onclick="document.forms[0].x{$BASEID}_action.value='addProfileConfirm'" />
<br /><br />
<table cellspacing="0" cellpadding="0" width="100%">
 <tr><td colspan="4" class="table_header">{"Profile"|translate}</td></tr>
 {foreach from=$PROFILE key=FIELD item=ROW}
 <tr class="{cycle values="row_a,row_b"}">
  <td class="left">{$ROW.label}</td>
  {if $ROW.type == 'text'}
    <td class="left"><b>{$ROW.value}</b><input type="hidden" name="x{$BASEID}_{$FIELD}" value="{$ROW.value}"></td>
  {/if}
  {if $ROW.type == 'inputtext'}
    <td class="right"><input type="text" name="x{$BASEID}_{$FIELD}" value="{$ROW.value}" size="{$ROW.size}"></td>
  {/if}
 </tr>
 {/foreach}
</table>
</form>
