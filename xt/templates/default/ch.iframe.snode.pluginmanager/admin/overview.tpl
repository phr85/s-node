<form method="POST">
 <input type="hidden" name="x{$BASEID}_action" value="">
 {foreach from=$BUTTONS item=BUTTON}
  <input type="submit" value="{$BUTTON.label}" name="submit_{$BUTTON.action}" class="{$BUTTON.class}" onclick="document.forms[0].x{$BASEID}_action.value='{$BUTTON.action}'" {$BUTTON.disabled}>&nbsp;
 {/foreach}
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td class="table_header" width="80">{"Options"|translate}</td>
        <td class="table_header" width="50">{"ID"|translate}</td>
        <td class="table_header" width="200">{"Name"|translate}</td>
        <td class="table_header" width="200">{"Description"|translate}</td>
        <td class="table_header">{"Update status"|translate}</td>
    </tr>
    {foreach from=$PACKAGES item=PACKAGE}
    <tr class="{cycle values="row_a,row_b"}">
        <td class="button"><a href="{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=showPackage&x{$BASEID}_id={$PACKAGE.id}"><img src="images/icons/view.gif" width="16" height="16" alt="{"Show"|translate}" /></a></td>
        <td class="row">{$PACKAGE.base_id}</td>
        <td class="row">{$PACKAGE.title}</td>
        <td class="row">{$PACKAGE.description}</td>
        {if $UPDATES[$PACKAGE.package_id]}
        <td class="row" style="padding: 3px;">
         <table cellspacing="0" cellpadding="0" width="100%">
          <tr>
           <td width="20"><img src="images/icons/environment_information.png" alt="{"Update status"|translate}" /></td>
           <td style="color: blue;">{"There are updates available"|translate} (<b>{$UPDATES[$PACKAGE.package_id].count}</b>)</td>
          </tr>
         </table>
        </td>
        {else}
        <td class="row" style="padding: 3px;">
         <table cellspacing="0" cellpadding="0" width="100%">
          <tr>
           <td width="20"><img src="images/icons/environment_ok.png" alt="{"Update status"|translate}" /></td>
           <td style="color: green;">{"Up to date"|translate}</td>
          </tr>
         </table>
        </td>
        {/if}
    </tr>
    {/foreach}
</table>
</form>