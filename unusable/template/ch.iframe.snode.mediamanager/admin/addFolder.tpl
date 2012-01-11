<form method="POST" name="uploadpic" enctype="multipart/form-data">
 {include file="includes/buttons.tpl" data=$BUTTONS}
 <table cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td class="table_header" colspan="2">{"Add folder"|translate}</td>
  </tr>
  <tr>
   <td class="left">{"Target folder"|translate}</td>
   <td class="right"><input type="hidden" name="x{$BASEID}_folder" value="{$FOLDER_ID}">&raquo; {$FOLDER}</td>
  </tr>
  <tr>
   <td class="left">{"Folder name"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_folder_name" size="34"></td>
  </tr>
  <tr>
   <td class="left" style="padding-top: 3px; vertical-align: top;">{"Description"|translate}</td>
   <td class="right"><textarea name="x{$BASEID}_description" cols="50"></textarea></td>
  </tr>
 </table>
</form>