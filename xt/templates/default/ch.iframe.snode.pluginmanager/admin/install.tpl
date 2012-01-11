<form method="POST" enctype="multipart/form-data">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Install new packages, modules or extensions"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Choose file to install"|translate}</td>
  <td class="right"><input type="file" name="x{$BASEID}_file" size="40"></td>
 </tr>
</table>
</form>
