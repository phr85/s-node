<form method="POST">
 <input type="hidden" name="x{$BASEID}_action" value="">
 {foreach from=$BUTTONS item=BUTTON}
  <input type="submit" value="{$BUTTON.label}" name="submit_{$BUTTON.action}" class="{$BUTTON.class}" onclick="document.forms[0].x{$BASEID}_action.value='{$BUTTON.action}'" {$BUTTON.disabled}>&nbsp;
 {/foreach}
</form><br />

<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td class="table_header">{"Package"|translate}</td>
        <td class="table_header">{"Module"|translate}</td>
        <td class="table_header">{"Version"|translate}</td>
        <td class="table_header">{"Required version"|translate}</td>
    </tr>
    {foreach from=$UPDATES item=UPDATE}
    <tr class="{cycle values="row_a,row_b"}">
        <td class="row">{$UPDATE.package}</td>
        <td class="row">{$UPDATE.module}</td>
        <td class="row">{$UPDATE.version}</td>
        <td class="row">{$UPDATE.reqversion}</td>
    </tr>
    {/foreach}
</table>