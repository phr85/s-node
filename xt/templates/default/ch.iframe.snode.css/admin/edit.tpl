<form method="post" name="edit">
{include file="includes/buttons.tpl" data=$BUTTONS}
<h2>{$THEME}/{$FILE}</h2>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td style="padding: 5px;">
   <textarea name="x{$BASEID}_code"rows="50" style="background-color: #FFFFFF;width:98%; padding:5px;">{$CODE}</textarea>
  </td>
 </tr>
</table>

<input type="hidden" name="x{$BASEID}_theme" value="{$THEME}" />
<input type="hidden" name="x{$BASEID}_file" value="{$FILE}" />
</form>
