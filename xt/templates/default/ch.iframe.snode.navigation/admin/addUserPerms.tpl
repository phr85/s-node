<form method="POST" name="addUserPerms">
<input type="hidden" name="x{$BASEID}_action" />
<input type="submit" value="{$LABEL_SUBMIT}" name="submit" class="button" onclick="document.forms['addUserPerms'].x{$BASEID}_action.value='addUserPermissionConfirm'" />
<br /><br />
<table cellspacing="0" cellpadding="0" width="100%" class="admin_table">
 <tr class="header"><td colspan="3" class="header">{$LABEL_CHOOSEUSER}</td></tr>
 <tr class="{cycle values="row_a,row_b"}">
  <td class="row" width="200" valign="top">{$LABEL_USERNAME}</td>
  <td class="row_form"><input type="text" name="x{$BASEID}_username" size="25"></td>
  <td colspan="3" valign="top">&nbsp;</td>
 </tr>
</table>
</form>
