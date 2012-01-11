<form method="POST">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td style="padding: 5px;">
   <textarea name="x{$BASEID}_code" style="width: 100%" rows="30" class="code">{$BUFFER}</textarea>
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_open" value="" />
</form>
