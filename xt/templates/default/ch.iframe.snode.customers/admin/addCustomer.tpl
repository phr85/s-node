<form method="POST">
{include file="includes/buttons.tpl" data=$ADD_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Customer data"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Name"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Customer Nr."|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_cnr" size="6"></td>
 </tr>
 <tr>
  <td class="left">{"Postal code / City"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_postalCode" size="6"> <input type="text" name="x{$BASEID}_city" size="31"></td>
 </tr>
 <tr>
  <td class="left">{"Telephone"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_tel" size="20"></td>
 </tr>
 <tr>
  <td class="left">{"Facsimile"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_facsimile" size="20"></td>
 </tr>
</table>
</form>
