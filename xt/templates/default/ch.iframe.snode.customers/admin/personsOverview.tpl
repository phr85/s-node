<form method="POST" name="overview">
{include file="includes/buttons.tpl" data=$PERSONS_BUTTONS}
{include file="includes/charfilter.tpl" form="overview"}
<!--
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="light_toolbar"><input type="text" name="x{$BASEID}_term" size="25"><input type="image" src="{$XT_IMAGES}icons/view.png" align="middle" style="padding: 0px 0px 4px 2px"></td>
  </tr>
</table>
-->
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header" width="40">{"ID"|translate}</td>
  <td class="table_header" width="100">{"Customer Nr."|translate}</td>
  <td class="table_header" width="150">{"Name"|translate}</td>
  <td class="table_header" width="150">{"E-Mail"|translate}</td>
  <td class="table_header" width="150">{"Company"|translate}</td>
  <td class="table_header" width="150">{"Position"|translate}</td>
  <td class="table_header">{"Adv. options"|translate}</td>
 </tr>
 {foreach from=$PERSONS item=PERSON}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{if $PERSON.active == 1}{
  actionIcon
      action="deactivatePerson"
      icon="active.png"
      perm="statuschange"
      form="overview"
      title="Deactivate this person"
      person_id=$PERSON.id
  }{else}{
  actionIcon
      action="activatePerson"
      icon="inactive.png"
      perm="statuschange"
      form="overview"
      title="Activate this person"
      person_id=$PERSON.id
  }{/if}{
  actionIcon
      action="viewPerson"
      icon="view.png"
      perm="view"
      form="overview"
      title="View information about this person"
      person_id=$PERSON.id
  }{
  actionIcon
      action="editPerson"
      icon="pencil.png"
      perm="editCustomer"
      form="overview"
      title="Edit this person"
      person_id=$PERSON.id
  }{if $PERSON.active == 0}{
  actionIcon
      action="deletePerson"
      icon="delete.png"
      perm="deleteCustomer"
      form="overview"
      title="Delete this person"
      ask="Are you sure, you want to delete this person?"
      person_id=$PERSON.id
  }{/if}</td>
  <td class="row">{$PERSON.id}</td>
  <td class="row">{if $PERSON.cnr != ''}{$PERSON.cnr}{else}<span style="color: #BBBBBB;">{"Not available"|translate}</span>{/if}&nbsp;</td>
  <td class="row">{$PERSON.lastName} {$PERSON.firstName}&nbsp;</td>
  <td class="row"><a href="mailto:{$PERSON.email}">{$PERSON.email}</a>&nbsp;</td>
  <td class="row">{$PERSON.company}&nbsp;</td>
  <td class="row">{if $PERSON.position != ''}{$PERSON.position}{else}<span style="color: #BBBBBB;">{"Not available"|translate}</span>{/if}&nbsp;</td>
  <td class="button">
  {if $PERSON.tel != ''}<a href="callto://{$PERSON.tel}"><img src="images/icons/telephone.png" style="padding-right: 4px;" alt="{'Call this person'|translate}" title="{'Call this person'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-right: 4px;" alt="{'Call this person'|translate}" title="{'Call this person'|translate}" />{/if}<br /></td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_person_id" value="" />
{include file="includes/navigator.tpl" form="overview"}
</form>
