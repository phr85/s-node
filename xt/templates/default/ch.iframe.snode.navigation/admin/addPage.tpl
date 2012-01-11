<form method="POST">
<input type="hidden" name="x{$BASEID}_action" />
<input type="submit" value="{$LABEL_SUBMIT}" name="submit" class="submit" onclick="document.forms[0].x{$BASEID}_action.value='addPageConfirm'" />
<table cellspacing="0" cellpadding="0" width="100%" class="admin_table">
 <tr class="header"><td colspan="4" class="header"><b>{"Base data"|translate}</b></td></tr>
 {foreach from=$PROFILE key=FIELD item=ROW}
 <tr class="{cycle values="row_a,row_b"}">
  <td class="row" width="200" valign="top">{$ROW.label}</td>
  {if $ROW.type == 'text'}
    <td class="row" width="280"><b>{$ROW.value}</b><input type="hidden" name="x{$BASEID}_{$FIELD}" value="{$ROW.value}"></td>
  {/if}
  {if $ROW.type == 'inputtext'}
    <td class="row_form" width="280"><input type="text" name="x{$BASEID}_{$FIELD}" value="{$ROW.value}" size="{$ROW.size}"></td>
  {/if}
  {if $ROW.error != ''}
  <td width="16" valign="top" class="icon"><img src="images/icons/warning.png" alt="" /><br /></td>
  <td class="row_warning" valign="top">{$ROW.error}</td>
  {else}
  <td colspan="2" valign="top">&nbsp;</td>
  {/if}
 </tr>
 {/foreach}
</table>
</form>
