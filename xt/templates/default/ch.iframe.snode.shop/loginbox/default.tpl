<form method="post" action="{$smarty.server.PHP_SELF}">
<table cellpadding="0" cellspacing="0">
 <tr>
  <td class="usermanager_loginbox_left">{"Username"|translate}:</td>
  <td class="usermanager_loginbox_right"><input type="text" name="{$FIELD_USERNAME}" /></td>
 </tr>
 <tr>
  <td class="usermanager_loginbox_left">{"Password"|translate}:</td>
  <td class="usermanager_loginbox_right"><input type="password" name="{$FIELD_PASSWORD}" /></td>
 </tr>
 <tr>
  <td class="usermanager_loginbox_left" colspan="2" align="right">
   <input type="submit" name="submit" value="{'Login'|translate}" />
  </td>
 </tr>
</table>
</form>