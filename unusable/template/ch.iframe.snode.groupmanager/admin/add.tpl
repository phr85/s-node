<form method="POST">
<input type="hidden" name="x{$BASEID}_action">
<input type="submit" value="{'Add group'|translate}" name="submit" class="button" onclick="document.forms[0].x{$BASEID}_action.value='addGroupConfirm'">
<br><br>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Group data"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Name"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_title"></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right"><textarea cols="50" rows="3" name="x{$BASEID}_description"></textarea></td>
 </tr>
</table>
</form>
