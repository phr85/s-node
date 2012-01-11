<form method="POST" name="edit">
{include file="includes/buttons.tpl" data=$EDIT_PERSON_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Customer"|translate}:</span> <span class="title">{$PERSON.lastName} {$PERSON.firstName}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Customer Nr."|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_cnr" value="{$PERSON.cnr}" size="8">
 </tr>
 <tr>
  <td class="left">{"Linked to user"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_user_id" onChange="document.forms['edit'].x{$BASEID}_action.value='savePerson';document.forms['edit'].submit();">
    <option value="0" {if $PERSON.user_id == 0}selected{/if}>{"Not assigned"|translate}</option>
    {foreach from=$USERS item=USER}
    <option value="{$USER.id}" {if $PERSON.user_id == $USER.id}selected{/if}>{$USER.username}</option>
    {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Name"|translate}</td>
  <td class="right"><select name="x{$BASEID}_gender">
  <option value="1" {if $PERSON.gender == 1}selected{/if}>{"Mr."|translate}</option>
  <option value="2" {if $PERSON.gender == 2}selected{/if}>{"Mrs."|translate}</option>
  </select> <input type="text" name="x{$BASEID}_lastName" value="{$PERSON.lastName}" size="31">
 </tr>
 <tr>
  <td class="left">{"First name"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_firstName" value="{$PERSON.firstName}" size="42">
 </tr>
 <tr>
  <td class="left">{"Company"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_customer_id" onChange="document.forms['edit'].x{$BASEID}_action.value='savePerson';document.forms['edit'].submit();">
    <option value="0" {if $PERSON.customer_id == 0}selected{/if}>{"Not assigned"|translate}</option>
    {foreach from=$CUSTOMERS item=CUSTOMER}
    <option value="{$CUSTOMER.id}" {if $PERSON.customer_id == $CUSTOMER.id}selected{/if}>{$CUSTOMER.title}</option>
    {/foreach}
   </select>
  </td>
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
  <td class="right"><input type="text" name="x{$BASEID}_street" value="{$PERSON.street}" size="28"> <input type="text" name="x{$BASEID}_street_nr" value="{$PERSON.street_nr}" size="4"></td>
 </tr>
 <tr>
  <td class="left">{"Postal code / City"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_cityCode" value="{$PERSON.cityCode}" size="4"> <input type="text" name="x{$BASEID}_city" value="{$PERSON.city}" size="28"></td>
 </tr>
 <tr>
  <td class="left">{"Country"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_country">
   {foreach from=$COUNTRIES item=COUNTRY}
   <option value="{$COUNTRY.country}" {if $COUNTRY.country == $PERSON.country}selected{/if}>{$COUNTRY.name}</option>
   {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Telephone"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_tel" size="20" value="{$PERSON.tel}">{if $PERSON.tel != ''}<a href="callto://{$PERSON.tel}"><img src="images/icons/telephone.png" style="padding-right: 4px; margin-top: 5px; float: left;" alt="{'Call this person'|translate}" title="{'Call this person'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-right: 4px;" alt="{'Call this person'|translate}" title="{'Call this person'|translate}" />{/if}</td>
 </tr>
 <tr>
  <td class="left">{"E-Mail"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_email" value="{$PERSON.email}" size="42">
 </tr>
 <tr>
  <td class="left">{"Position"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_position" value="{$PERSON.position}" size="42">
 </tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Comment"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Comment"|translate}</td>
  <td class="right"><textarea name="x{$BASEID}_comment" rows="6" cols="70">{$PERSON.comment}</textarea></td>
 </tr>
</table>
</form>
