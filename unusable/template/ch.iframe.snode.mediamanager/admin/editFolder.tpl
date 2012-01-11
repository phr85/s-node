<form method="POST" name="edit_folder">
 {include file="includes/buttons.tpl" data=$EDIT_FOLDER_BUTTONS}
 {include file="includes/lang_selector_submit.tpl" form="edit_folder" action="saveFolder"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" colspan="2">{"Folder data"|translate}</td>
  </tr>
  <tr>
   <td class="left">{"Name"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_title" value="{$FOLDER.title}" size="42"></td>
  </tr>
  <tr>
   <td class="left">{"Description"|translate}</td>
   <td class="right"><textarea name="x{$BASEID}_description" cols="50">{$FOLDER.description}</textarea></td>
  </tr>
 </table>
 <input type="hidden" name="x{$BASEID}_node_id" value="{$NODE_ID}">
 <input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}">
</form>
