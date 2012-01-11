<form method="POST">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
  <td colspan="2" class="table_header">{"Update server"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Choose update server"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_update_server">
    <option value="">iframe AG, Schweiz</option>
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Choose price currency"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_update_server">
    {foreach from=$CURRENCIES key=KEY item=CURRENCY}
    <option value="{$KEY}">{$CURRENCY.name} ({$CURRENCY.suffix})</option>
    {/foreach}
   </select>
  </td>
 </tr>
</table>
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
  <td colspan="6" class="admin_title">{"Approved full packages"|translate}</td>
 </tr>
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header" width="30" style="padding: 3px; padding-left: 6px; padding-right: 0px;"><input type="checkbox" name="x{$BASEID}_checkall"></td>
  <td class="table_header" width="200">{"Package"|translate}</td>
  <td class="table_header" width="250">{"Description"|translate}</td>
  <td class="table_header" width="50">{"Cost"|translate} €</td>
  <td class="table_header">{"Buy & Download"|translate}</td>
 </tr>
 {foreach from=$PACKAGES item=PACKAGE}
 <tr class="{cycle values="row_a,row_b"}">
  <td class="row"><a href="{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=SOAP_showPackage&x{$BASEID}_id={$PACKAGE.id}"><img src="images/icons/view.gif" width="16" height="16" alt="{"Show"|translate}" /></a></td>
  <td class="row"><input type="checkbox" name="x{$BASEID}_task[{$TASK.id}]"></td>
  <td class="row">{$PACKAGE.title}</td>
  <td class="row">{$PACKAGE.description}</td>
  <td class="row">{$PACKAGE.price} &euro;</td>
  <td class="row"><img src="{$XT_IMAGES}icons/download.png" alt="{'Download'|translate}" /></td>
 </tr>
 {/foreach}
</table>
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
  <td colspan="6" class="admin_title">Non approved packages <b>The code & functional quality of the following packages is not guaranteed.</b></td>
 </tr>
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header" width="30" style="padding: 3px; padding-left: 6px; padding-right: 0px;"><input type="checkbox" name="x{$BASEID}_checkall"></td>
  <td class="table_header" width="200">{"Package"|translate}</td>
  <td class="table_header" width="250">{"Description"|translate}</td>
  <td class="table_header" width="50">{"Cost"|translate} €</td>
  <td class="table_header">{"Buy & Download"|translate}</td>
 </tr>
 {foreach from=$PACKAGES item=PACKAGE}
 <tr class="{cycle values="row_a,row_b"}">
  <td class="row"><a href="{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=SOAP_showPackage&x{$BASEID}_id={$PACKAGE.id}"><img src="images/icons/view.gif" width="16" height="16" alt="{"Show"|translate}" /></a></td>
  <td class="row"><input type="checkbox" name="x{$BASEID}_task[{$TASK.id}]"></td>
  <td class="row">{$PACKAGE.title}</td>
  <td class="row">{$PACKAGE.description}</td>
  <td class="row">{$PACKAGE.price} &euro;</td>
  <td class="row"><img src="{$XT_IMAGES}icons/download.png" alt="{'Download'|translate}" /></td>
 </tr>
 {/foreach}
</table>
</form>