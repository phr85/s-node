{literal}
<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
{/literal}
<form method="POST" name="edit">
{include file="includes/buttons.tpl" data=$CREATE_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{$PROJECT.title}</span><br />
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$PROJECT.title}"></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right"><textarea name="x{$BASEID}_description" cols="50" rows="3">{$PROJECT.description}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Budget range"|translate}</td>
  <td class="right">
   {"From"|translate}: <input type="text" name="x{$BASEID}_budget_start" size="10" value="{$PROJECT.budget_start}"> CHF
   {"To"|translate}: <input type="text" name="x{$BASEID}_budget_end" size="10" value="{$PROJECT.budget_end}"> CHF
  </td>
 </tr>
 <tr>
  <td class="left">{"Start"|translate}</td>
  <td class="right">{html_select_date time=$PROJECT.start_date prefix="start_date"} {html_select_time use_24_hours=true time=$PROJECT.start_date prefix="start_time"}</td>
 </tr>
 <tr>
  <td class="left">{"Deadline"|translate}</td>
  <td class="right">{html_select_date time=$PROJECT.end_date prefix="end_date"} {html_select_time use_24_hours=true time=$PROJECT.end_date prefix="end_time"}</td>
 </tr>
 <tr>
  <td class="left">{"Accounting"|translate}</td>
  <td class="right">
   <input type="radio" name="x{$BASEID}_accounting_type" value="1"> {"after finish"|translate}
   <input type="radio" name="x{$BASEID}_accounting_type" value="3"> {"per step"|translate}
   <input type="radio" name="x{$BASEID}_accounting_type" value="2"> {"per month"|translate}
   <input type="radio" name="x{$BASEID}_accounting_type" value="4"> à conto
  </td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Client"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_customer_id" onChange="document.forms['edit'].x{$BASEID}_action.value='saveProject';document.forms['edit'].submit();">
    {foreach from=$CUSTOMERS item=CUSTOMER}
    <option value="{$CUSTOMER.id}" {if $PROJECT.customer_id == $CUSTOMER.id}selected{/if}>{$CUSTOMER.title}</option>
    {/foreach}
   </select>
  </td>
 </tr>
 {if sizeof($CUSTOMER_PERSONS) > 0}
 <tr>
  <td class="left">{"Client project lead"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_customer_contact_id">
    {foreach from=$CUSTOMER_PERSONS item=CUSTOMER_PERSON}
    <option value="{$CUSTOMER_PERSON.id}" {if $PROJECT.customer_id == $CUSTOMER_PERSON.id}selected{/if}>{$CUSTOMER_PERSON.lastName}, {$CUSTOMER_PERSON.firstName} ({$CUSTOMER_PERSON.position})</option>
    {/foreach}
   </select>
  </td>
 </tr>
 {/if}
 <tr>
  <td class="left">{"Project lead"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_lead_id">
    {foreach from=$EMPLOYEES item=EMPLOYEE}
    <option value="{$EMPLOYEE.id}" {if $PROJECT.lead_id == $EMPLOYEE.id}selected{/if}>{$EMPLOYEE.lastName}, {$EMPLOYEE.firstName}</option>
    {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Team"|translate}</span><br />
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_PEOPLE_BUTTONS withouthidden="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 {foreach from=$MEMBERS item=MEMBER}
 <tr>
  <td class="left">{$MEMBER.role}</td>
  <td class="right"><img src="{$XT_IMAGES}icons/user_small.png" alt="" />&nbsp;&nbsp;{$MEMBER.lastName}, {$MEMBER.firstName}</td>
  <td class="right" style="padding-top: 4px; padding-bottom: 0px;" align="right">{
  actionIcon
      action="editMember"
      icon="pencil.png"
      form="0"
      member_id=$MEMBER.id
      title="Edit this member"
  }{
  actionIcon
      action="deleteMember"
      icon="delete.png"
      form="0"
      member_id=$MEMBER.id
      title="Delete this member"
      ask="Are you sure you want to delete this person from this project?"
  }</td>
 </tr>
 {/foreach}
 <tr>
  <td class="view_header" colspan="4">
   <span class="title">{"Steps"|translate}</span><br />
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_STEPS_BUTTONS withouthidden="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 {foreach from=$STEPS item=STEP}
 <tr>
  <td class="left_without" style="padding-left: {$STEP.level*15-25}px">
   {if $STEP.subs > 0}<img src="{$XT_IMAGES}icons/gears_small.png" alt="" />{else}<img src="{$XT_IMAGES}icons/gear_small.png" alt="" />{/if}&nbsp;&nbsp;{$STEP.label} <span style="color: black;" />{$STEP.title}</span>
  </td>
  <td class="right" style="width: 70px;">{$STEP.real_duration_display} ({$STEP.duration_display}) {if $STEP.real_duration_display == 1}{"Day"|translate}{else}{"Days"|translate}{/if}&nbsp;</td>
  <td class="right" style="width: 70px; background-color: #EFD8D8;" align="right">~{math equation="x*y" x=$STEP.duration y=$PERUNITBUDGET format="%.0f"}&nbsp;CHF</td>
  <td class="right" style="padding-top: 4px; padding-bottom: 0px; width: 80px;" align="right">{
  if $CTRL
      }{actionIcon
            action="insertNode"
            icon="explorer/arrow_down_green.png"
            form="navigation"
            node_perm="addPages"
            node_pid=$NODE.pid
            node_id=$NODE.id
            position="after"
            title="Insert after this node"
      }{actionIcon
            action="insertNode"
            icon="explorer/arrow_up_green.png"
            form="navigation"
            node_perm="addPages"
            node_pid=$NODE.pid
            node_id=$NODE.id
            position="before"
            title="Insert before this node"
      }{actionIcon
            action="insertNode"
            icon="explorer/folder_into.png"
            form="navigation"
            node_perm="addPages"
            node_pid=$NODE.pid
            node_id=$NODE.id
            position="into"
            title="Insert into this node"
  }{else}{
  actionIcon
      action="cutNode"
      icon="cut.png"
      form="navigation"
      node_id=$NODE.id
      node_pid=$NODE.pid
      node_perm="deletePages"
      title="Cut this page node"
  }{
  actionIcon
      action="copyNode"
      icon="copy.png"
      form="navigation"
      source_node_id=$NODE.id
      title="Copy this page node"
  }{
  actionIcon
      action="editMember"
      icon="pencil.png"
      form="0"
      member_id=$MEMBER.id
      title="Edit this member"
  }{
  actionIcon
      action="deleteMember"
      icon="delete.png"
      form="0"
      member_id=$MEMBER.id
      title="Delete this member"
      ask="Are you sure you want to delete this person from this project?"
  }{/if}</td>
 </tr>
 {/foreach}
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Estimated"|translate}</span><br />
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Estimated project duration"|translate}:</td>
  <td class="right">{$TOTAL_REAL_DURATION} {if $TOTAL_REAL_DURATION == 1}{"Day"|translate}{else}{"Days"|translate}{/if}</td>
 </tr>
 <tr>
  <td class="left">{"Estimated work time"|translate}:</td>
  <td class="right">{$TOTAL_DURATION} {if $TOTAL_DURATION == 1}{"Day"|translate}{else}{"Days"|translate}{/if}</td>
 </tr>
 <tr>
  <td class="left">{"Estimated end date"|translate}:</td>
  <td class="right">{$END_TIME|date_format:"%d.%m.%Y %H:%I"}</td>
 </tr>
 <tr>
  <td class="left">{"Estimated time left"|translate}:</td>
  <td class="right"><span style="color: green;">~{$TIME_LEFT} {"Days"|translate}</span></td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_project_id" />
<input type="hidden" name="x{$BASEID}_member_id" />
</form>
