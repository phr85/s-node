<form method="POST" name="edit_customer">
{include file="includes/buttons.tpl" data=$EDIT_CUSTOMER_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Customer"|translate}:</span><span class="title"> {$CUSTOMER.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Name"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$CUSTOMER.title}"></td>
 </tr>
 <tr>
  <td class="left">{"Customer Nr."|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_cnr" size="6" value="{$CUSTOMER.cnr}"></td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Contact information"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Street / Nr."|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_street" value="{$CUSTOMER.street}" size="28"> <input type="text" name="x{$BASEID}_street_nr" value="{$CUSTOMER.street_nr}" size="4"></td>
 </tr>
 <tr>
  <td class="left">{"PO Box"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_po_box" size="20" value="{$CUSTOMER.po_box}"></td>
 </tr>
 <tr>
  <td class="left">{"Postal code / City"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_postalCode" size="4" value="{$CUSTOMER.postalCode}"> <input type="text" name="x{$BASEID}_city" size="28" value="{$CUSTOMER.city}"></td>
 </tr>
 <tr>
  <td class="left">{"Country"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_country">
   {foreach from=$COUNTRIES item=COUNTRY}
   <option value="{$COUNTRY.country}" {if $COUNTRY.country == $CUSTOMER.country}selected{/if}>{$COUNTRY.name}</option>
   {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Telephone"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_tel" size="20" value="{$CUSTOMER.tel}"></td>
 </tr>
 <tr>
  <td class="left">{"Facsimile"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_facsimile" size="20" value="{$CUSTOMER.facsimile}"></td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Customer relation details"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Our main consultant"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_our_consultant">
    {foreach from=$EMPLOYEES item=EMPLOYEE}
    <option value="{$EMPLOYEE.id}" {if $EMPLOYEE.id == $CUSTOMER.our_consultant}selected{/if}>{$EMPLOYEE.lastName}, {$EMPLOYEE.firstName}</option>
    {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Our main technician"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_our technician">
    {foreach from=$EMPLOYEES item=EMPLOYEE}
    <option value="{$EMPLOYEE.id}" {if $EMPLOYEE.id == $CUSTOMER.our_technician}selected{/if}>{$EMPLOYEE.lastName}, {$EMPLOYEE.firstName}</option>
    {/foreach}
   </select>
  </td>
 </tr>
</table>
<!--
<table cellspacing="0" cellpadding="0">
 <tr style="cursor: hand; cursor: pointer;">
  <td onclick="window.location.href='{$smarty.server.PHP_SELF}?{foreach from=$smarty.get key=GETKEY item=GETVAR}{if substr($GETKEY,-13) != 'customer_mode'}{$GETKEY}={$GETVAR}&{/if}{/foreach}&x{$BASEID}_customer_mode=contact_persons'" class="lang_tab{if $CUSTOMER_MODE == 'contact_persons'}_active{/if}"><img src="{$XT_IMAGES}icons/user1.png" alt="{'Contact persons'|translate}" title="{'Contact persons'|translate}" /></td>
  <td onclick="window.location.href='{$smarty.server.PHP_SELF}?{foreach from=$smarty.get key=GETKEY item=GETVAR}{if substr($GETKEY,-13) != 'customer_mode'}{$GETKEY}={$GETVAR}&{/if}{/foreach}&x{$BASEID}_customer_mode=contact_persons'" class="lang_tab{if $CUSTOMER_MODE == 'contact_persons'}_active{/if}" style="text-transform: none; padding-right: 10px;">{'Contact persons'|translate}</td>

  <td onclick="window.location.href='{$smarty.server.PHP_SELF}?{foreach from=$smarty.get key=GETKEY item=GETVAR}{if substr($GETKEY,-13) != 'customer_mode'}{$GETKEY}={$GETVAR}&{/if}{/foreach}&x{$BASEID}_customer_mode=projects'" class="lang_tab{if $CUSTOMER_MODE == 'projects'}_active{/if}"><img src="{$XT_IMAGES}icons/group.png" alt="{'Projects'|translate}" title="{'Projects'|translate}" /></td>
  <td onclick="window.location.href='{$smarty.server.PHP_SELF}?{foreach from=$smarty.get key=GETKEY item=GETVAR}{if substr($GETKEY,-13) != 'customer_mode'}{$GETKEY}={$GETVAR}&{/if}{/foreach}&x{$BASEID}_customer_mode=projects'" class="lang_tab{if $CUSTOMER_MODE == 'projects'}_active{/if}" style="text-transform: none; padding-right: 10px;">{'Projects'|translate}</td>

  <td onclick="window.location.href='{$smarty.server.PHP_SELF}?{foreach from=$smarty.get key=GETKEY item=GETVAR}{if substr($GETKEY,-13) != 'customer_mode'}{$GETKEY}={$GETVAR}&{/if}{/foreach}&x{$BASEID}_customer_mode=other'" class="lang_tab{if $CUSTOMER_MODE == 'other'}_active{/if}"><img src="{$XT_IMAGES}icons/worker.png" alt="{'Other'|translate}" title="{'Other'|translate}" /></td>
  <td onclick="window.location.href='{$smarty.server.PHP_SELF}?{foreach from=$smarty.get key=GETKEY item=GETVAR}{if substr($GETKEY,-13) != 'customer_mode'}{$GETKEY}={$GETVAR}&{/if}{/foreach}&x{$BASEID}_customer_mode=other'" class="lang_tab{if $CUSTOMER_MODE == 'other'}_active{/if}" style="text-transform: none; padding-right: 10px;">{'Other'|translate}</td>
 </tr>
</table>
{include file="includes/charfilter.tpl" form="edit_customer"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header" width="150">{"Name"|translate}</td>
  <td class="table_header" width="150">{"Position"|translate}</td>
  <td class="table_header">{"Adv. options"|translate}</td>
 </tr>
 {foreach from=$PERSONS item=PERSON}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">
  {if "statuschange"|allowed}{if $PERSON.active == 1}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&module=ec&x{$BASEID}_action=deactivatePerson&x{$BASEID}_person_id={$PERSON.id}"><img src="images/icons/active.gif" style="padding-right: 4px;" alt="{'Deactivate this person'|translate}" title="{'Deactivate this person'|translate}" /></a>{else}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&module=ec&x{$BASEID}_action=activatePerson&x{$BASEID}_person_id={$PERSON.id}"><img src="images/icons/inactive.gif" style="padding-right: 4px;" alt="{'Activate this person'|translate}" title="{'Activate this person'|translate}" /></a>{/if}{else}{$ICONSPACER}{/if}{if "view"|allowed}<a href="{$INDEX_PHP}?TPL={$TPL}&module=ec&x{$BASEID}_action=view&x{$BASEID}_id={$PERSON.id}"><img src="images/icons/view.gif" style="padding-right: 4px;" alt="{'View information about this person'|translate}" title="{'View information about this person'|translate}" /></a>{else}{$ICONSPACER}{/if}{if "editCustomer"|allowed}<a href="{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=editPerson&x{$BASEID}_id={$PERSON.id}"><img src="images/icons/pencil.png" alt="{'Edit this person'|translate}" title="{'Edit this person'|translate}" style="padding-right: 4px;" /></a>{else}{$ICONSPACER}{/if}{if "deleteCustomer"|allowed}<a href="javascript:ask('{'Are you sure to delete this person?'|translate}','{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=deleteUser&x{$BASEID}_id={$PERSON.id}');"><img src="images/icons/delete.png" alt="{'Delete this person'|translate}" title="{'Delete this person'|translate}" /></a>{else}{$ICONSPACER}{/if}<br />
  </td>
  <td class="row">{$PERSON.lastName} {$PERSON.firstName}</td>
  <td class="row">{$PERSON.position}</td>
  <td class="button">
   <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=call&x{$BASEID}_id={$PERSON.id}">
   <img src="images/icons/telephone.png" style="padding-right: 4px;" alt="{'Call this person'|translate}" title="{'Call this person'|translate}" /></a><a href="{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=viewStatistics&x{$BASEID}_id={$PERSON.id}"><img src="images/icons/column-chart.png" style="padding-right: 4px;" alt="{'View person stats'|translate}" title="{'View person stats'|translate}" /></a><br /></td>
 </tr>
 {/foreach}
</table>
<br />
{include file="includes/navigator.tpl" form="edit_customer"}
-->
</form>
