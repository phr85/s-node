<form method="POST">
 <input type="hidden" name="x{$BASEID}_action" value="">
 {foreach from=$BUTTONS item=BUTTON}
  <input type="submit" value="{$BUTTON.label}" name="submit_{$BUTTON.action}" class="{$BUTTON.class}" onclick="document.forms[0].x{$BASEID}_action.value='{$BUTTON.action}'" {$BUTTON.disabled}>&nbsp;
 {/foreach}
</form><br />

<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td class="table_header">{"Filename"|translate}</td>
        <td class="table_header">{"MD5"|translate}</td>
        <td class="table_header">{"Original MD5"|translate}</td>
        <td class="table_header">{"Difference"|translate}</td>
    </tr>
    {foreach from=$MODULES item=MODULE}
    <tr class="{cycle values="row_a,row_b"}">
        <td class="row" width="400">{$MODULE.filename}</td>
        <td class="row">{$MODULE.md5}</td>
        <td class="row">{$MODULE.origmd5}</td>
        <td class="row"><img src="images/icons/{$MODULE.different}.png" width="16" height="16" alt="{"Difference"|translate}" /></td>
    </tr>
    {/foreach}
</table>