<form method="POST">
<input type="hidden" name="x{$BASEID}_action" />
<input type="submit" value="{'Add user'|translate}" name="submit" class="button" onclick="document.forms[0].x{$BASEID}_action.value='addUserConfirm'" />
<br /><br />
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"User data"|translate}</td>
 </tr>
 {foreach from=$USER key=FIELD item=ROW}
 <tr>
  <td class="left" valign="top">{$ROW.label}</td>
  {if $ROW.type == 'text'}
    <td class="left"><b>{$ROW.value}</b><input type="hidden" name="x{$BASEID}_{$FIELD}" value="{$ROW.value}"></td>
  {/if}
  {if $ROW.type == 'inputpassword'}
    <td class="right"><input type="password" name="x{$BASEID}_{$FIELD}" size="{$ROW.size}"></b></td>
  {/if}
  {if $ROW.type == 'inputtext'}
    <td class="right"><input type="text" name="x{$BASEID}_{$FIELD}" value="{$ROW.value}" size="{$ROW.size}"></td>
  {/if}
  {if $ROW.type == 'inputarea'}
    <td class="right">
     <textarea name="x{$BASEID}_{$FIELD}" rows="{$ROW.rows}" cols="{$ROW.cols}">{$ROW.value}</textarea>
    </td>
  {/if}
  {if $ROW.type == 'select'}
    <td class="right">
     <select name="x{$BASEID}_{$FIELD}">
      {html_options values=$ROW.value selected=$ROW.selected output=$ROW.value_labels}
     </select>
    </td>
  {/if}
 </tr>
 {/foreach}
</table>
</form>
