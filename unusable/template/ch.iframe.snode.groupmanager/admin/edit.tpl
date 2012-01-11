<form method="POST" name="edit">
<input type="hidden" name="x{$BASEID}_action" value="saveGroup">
<input type="hidden" name="x{$BASEID}_id" value="{$GROUP.id}">
<input type="submit" value="{'Save'|translate}" name="submit" class="button">
<br><br>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Group data"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Name"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_title" value="{$GROUP.title}"></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right"><textarea cols="50" rows="3" name="x{$BASEID}_description">{$GROUP.description}</textarea></td>
 </tr>
</table>
</form>
<br>
<form method="POST" name="addUserToGroup">
<input type="hidden" name="x{$BASEID}_action" value="">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Add user to this group"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Username"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_username">&nbsp;<input type="submit" class="button" value="Add user to group" onclick="document.forms['addUserToGroup'].x{$BASEID}_action.value='addUserToGroup'"></td>
 </tr>
</table>
</form>
<br>
<form method="POST" name="usertable">
 {include file="includes/buttons.tpl" data=$BUTTONS}
 {include file="includes/charfilter.tpl" form="edit"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header" width="100">{"Username"|translate}</td>
   <td class="table_header" width="100">{"Last name"|translate}</td>
   <td class="table_header" width="100">{"First name"|translate}</td>
   <td class="table_header">{"Last login"|translate}</td>
  </tr>
  {foreach from=$DATA item=USER name=USERTABLE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if "edit"|allowed}<a href="javascript:ask('{'Are you sure to remove user from group?'|translate}','index.php?TPL={$TPL}&x{$BASEID}_action=deleteUserFromGroup&x{$BASEID}_user_id={$USER.id}');"><img src="images/icons/delete.png" alt="{'Delete this user'|translate}" title="{'Delete this user'|translate}"></a>{else}{$ICONSPACER}{/if}<br>
       </td>
       <td class="row">{$USER.id}&nbsp;</td>
       <td class="row">{$USER.username}&nbsp;</td>
       <td class="row">{$USER.lastName}&nbsp;</td>
       <td class="row">{$USER.firstName}&nbsp;</td>
       <td class="row">
       {if $USER.last_login_date > 0}
        {$USER.last_login_date|date_format:"%d.%m.%Y %H:%M:%S"}
       {/if}
       &nbsp;
       </td>
      </tr>
  {/foreach}
 </table>
 <br>
 {include file="includes/navigator.tpl" form="edit"}
</form>