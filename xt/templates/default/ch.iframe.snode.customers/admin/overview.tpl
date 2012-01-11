<form method="POST" name="list">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
{include file="includes/charfilter.tpl" form="list"}
<!--
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="light_toolbar"><input type="text" name="x{$BASEID}_term"></td>
 </tr>
</table>
-->
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header" width="40">{"ID"|translate}</td>
  <td class="table_header" width="100">{"Customer Nr."|translate}</td>
  <td class="table_header" width="250">{"Title"|translate}</td>
  <td class="table_header" width="200">{"City"|translate}</td>
  <td class="table_header">{"Adv. options"|translate}</td>
 </tr>
 {foreach from=$CUSTOMERS item=CUSTOMER}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{if $CUSTOMER.active == 0}{
  actionIcon
      action="activateCustomer"
      icon="inactive.png"
      title="Activate this customer"
      form="list"
      customer_id=$CUSTOMER.id
  }{else}{
  actionIcon
      action="deactivateCustomer"
      icon="active.png"
      title="Deactivate this customer"
      form="list"
      customer_id=$CUSTOMER.id
  }{/if}{
  actionIcon
      action="editCustomer"
      icon="pencil.png"
      title="Edit this customer"
      form="list"
      customer_id=$CUSTOMER.id
  }{if $CUSTOMER.active == 0}{
  actionIcon
      action="deleteCustomer"
      icon="delete.png"
      title="Delete this customer"
      form="list"
      ask="Are you sure, you wanna delete this customer, including all the employees?"
      customer_id=$CUSTOMER.id
  }{/if}</td>
  <td class="row">{$CUSTOMER.id}</td>
  <td class="row">{if $CUSTOMER.cnr != ''}{$CUSTOMER.cnr}{else}<span style="color: #BBBBBB;">{"Not available"|translate}</span>{/if}</td>
  <td class="row"><a href="javascript:document.forms['list'].x{$BASEID}_open.value={$CUSTOMER.id};document.forms['list'].submit();">{if $PERSONS[$CUSTOMER.id]}<span style="color: black;">{$CUSTOMER.title}</span>{else}{$CUSTOMER.title}{/if}</a>&nbsp;</td>
  <td class="row">{$CUSTOMER.postalCode} {$CUSTOMER.city}&nbsp;</td>
  <td class="button">
   <a href="callto://{$CUSTOMER.tel}"><img src="images/icons/telephone.png" style="padding-right: 4px;" alt="{'Call this customer'|translate}" title="{'Call this customer'|translate}" /></a>{
  actionIcon
      action="addPerson"
      icon="user1_add.png"
      title="Add a person this customer"
      form="list"
      customer_id=$CUSTOMER.id
  }
  </td>
 </tr>
 {if $PERSONS[$CUSTOMER.id]}
 {foreach from=$PERSONS[$CUSTOMER.id] item=PERSON}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{if $PERSON.active == 0}{
  actionIcon
      action="activatePerson"
      icon="inactive.png"
      title="Activate this person"
      form="list"
      person_id=$PERSON.id
  }{else}{
  actionIcon
      action="deactivatePerson"
      icon="active.png"
      title="Deactivate this person"
      form="list"
      person_id=$PERSON.id
  }{/if}{
  actionIcon
      action="editPerson"
      icon="pencil.png"
      title="Edit this person"
      form="list"
      person_id=$PERSON.id
  }{if $PERSON.active == 0}{
  actionIcon
      action="deletePerson"
      icon="delete.png"
      title="Delete this person"
      form="list"
      ask="Are you sure, you wanna delete this person?"
      person_id=$PERSON.id
  }{/if}</td>
  <td class="row">&nbsp;</td>
  <td class="row" colspan="2"><img src="{$XT_IMAGES}icons/user_small.png" alt="" />&nbsp;&nbsp;<a href="#">{$PERSON.lastName}, {$PERSON.firstName}</a></td>
  <td class="row">{$PERSON.position}</td>
  <td class="row"><img src="{$XT_IMAGES}admin/arrow.gif" alt="" />&nbsp;&nbsp;<a href="mailto:{$PERSON.email}">{$PERSON.email}</a></td>
 </tr>
 {/foreach}
 {/if}
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_open" value="" />
<input type="hidden" name="x{$BASEID}_customer_id" value="" />
<input type="hidden" name="x{$BASEID}_person_id" value="" />
<input type="hidden" name="x{$BASEID}_module" value="o" />
{include file="includes/navigator.tpl" form="list"}
</form>
