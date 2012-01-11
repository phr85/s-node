<form method="POST" name="editElementValue">
<h2><span class="light">{"Value"|translate}:</span> {$DATA.label}</h2>
{include file="includes/buttons.tpl" data=$EDIT_VALUE_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Label"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_label" value="{$DATA.label|htmlspecialchars}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Value"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_value" value="{$DATA.value|htmlspecialchars}" size="42"></td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_value_id" value="{$DATA.id}" />
<input type="hidden" name="x{$BASEID}_script_id" />
<input type="hidden" name="x{$BASEID}_form_id" />
</form>