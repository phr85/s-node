<form method="POST">
{include file="includes/buttons.tpl" data=$EDIT_MEMBER_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Project role"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_role" size="42" value="{$MEMBER.role}"></td>
 </tr>
 <tr>
  <td class="left">{"Project lead"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_hr_id">
    {foreach from=$EMPLOYEES item=EMPLOYEE}
    <option value="{$EMPLOYEE.id}" {if $PROJECT.hr_id == $MEMBER.hr_id}selected{/if}>{$EMPLOYEE.lastName}, {$EMPLOYEE.firstName}</option>
    {/foreach}
   </select>
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_node_id" />
<input type="hidden" name="x{$BASEID}_node_pid" />
<input type="hidden" name="x{$BASEID}_position" />
<input type="hidden" name="x{$BASEID}_project_id" />
</form>
