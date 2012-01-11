<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="edit" onSubmit="window.document.forms['editArticle'].x{$BASEID}_yoffset.value= window.pageYOffset;">
<h2><span class="light">{"User"|translate}:</span> {$ADDRINFO.firstName} {$ADDRINFO.lastName} </h2>
{include file="includes/buttons.tpl" data=$EDITREG_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Firstname"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_firstName" value="{$ADDRINFO.firstName}"></td>
 </tr>
 <tr>
  <td class="left">{"Lastname"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_lastName" value="{$ADDRINFO.lastName}"></td>
 </tr>
 <tr>
  <td class="left">{"Street"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_street" value="{$ADDRINFO.street}"></td>
 </tr>
 <tr>
  <td class="left">{"Postal code"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_postalCode" value="{$ADDRINFO.postalCode}"></td>
 </tr>
 <tr>
  <td class="left">{"City"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_city" value="{$ADDRINFO.city}"></td>
 </tr>
 <tr>
  <td class="left">{"E-Mail"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_email" value="{$ADDRINFO.email}"></td>
 </tr>
 <tr>
  <td class="left">{"Phone"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_tel" value="{$ADDRINFO.tel}"></td>
 </tr>
 <tr>
</table>
<h2><span class="light">{"Information"|translate}:</span></h2>
<table cellspacing="0" cellpadding="0" width="100%">
{foreach from=$FIELDS key=KEY item=FIELD}
 <tr>
  <td class="left">{$FIELD.name|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_field[{$KEY}]" value="{$FIELD.value}"></td>
 </tr>
{/foreach}
 </table>
{include file="ch.iframe.snode.events/admin/hiddenValues.tpl"}
{include file="includes/editor.tpl"}
</form>