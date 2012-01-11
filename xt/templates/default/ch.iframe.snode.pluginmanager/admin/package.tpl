<form method="POST">
 <input type="hidden" name="x{$BASEID}_action" value="">
 {foreach from=$BUTTONS item=BUTTON}
  <input type="submit" value="{$BUTTON.label}" name="submit_{$BUTTON.action}" class="{$BUTTON.class}" onclick="document.forms[0].x{$BASEID}_action.value='{$BUTTON.action}'" {$BUTTON.disabled}>&nbsp;
 {/foreach}
</form><br />

<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td class="table_header">{"Options"|translate}</td>
        <td class="table_header">{"Label"|translate}</td>
        <td class="table_header">{"Module"|translate}</td>
        <td class="table_header">{"Version"|translate}</td>
        <td class="table_header">{"Path"|translate}</td>
        <td class="table_header">{"Description"|translate}</td>
        <td class="table_header">{"Modified"|translate}</td>
    </tr>
    {foreach from=$MODULES item=MODULE}
    <tr class="{cycle values="row_a,row_b"}">
        <td class="row" width="70"><a href="{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=showModule&x{$BASEID}_id={$MODULE.id}"><img src="images/icons/view.gif" width="16" height="16" alt="{"Show"|translate}" /></a></td>
        <td class="row" width="200">{$MODULE.label}</td>
        <td class="row">{$MODULE.module}</td>
        <td class="row">{$MODULE.version}</td>
        <td class="row">{$MODULE.path}</td>
        <td class="row">{$MODULE.description}</td>
        <td class="row"><img src="images/icons/{$MODULE.modified}.png" alt="&nbsp;" width="16" height="16" /></td>
    </tr>
    {/foreach}
</table>