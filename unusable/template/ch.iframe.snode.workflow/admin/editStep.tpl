<form method="POST">
{include file="includes/buttons.tpl" data=$EDIT_STEP_BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Step data"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="42"></td>
 </tr>
</table>
<br>
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Step members"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Users"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_users_repo" style="width: 180px;" size=12 multiple>
    {foreach from=$USERS item=USER}
     <option value="{$USER.id}">{$USER.username}</option>
    {/foreach}
   </select>
   <select name="x{$BASEID}_users" style="width: 180px;" size=12 multiple>
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Groups"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_groups_repo" style="width: 180px;" size=12 multiple>
    {foreach from=$GROUPS item=GROUP}
     <option value="{$GROUP.id}">{$GROUP.title}</option>
    {/foreach}
   </select>
   </select>
   <select name="x{$BASEID}_groups" style="width: 180px;" size=12 multiple>
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Roles"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_roles_repo" style="width: 180px;" size=12 multiple>
    {foreach from=$ROLES item=ROLE}
     <option value="{$ROLE.id}">{$ROLE.title}</option>
    {/foreach}
   </select>
   </select>
   <select name="x{$BASEID}_roles" style="width: 180px;" size=12 multiple>
   </select>
  </td>
 </tr>
</table>

</form>
