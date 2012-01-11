<form method="POST">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td colspan="2"><input type="text" name="x{$BASEID}_query" style="width: 100%"></td>
 </tr>
 <tr>
  <td style="padding-top: 3px;">
   <select name="x{$BASEID}_content_type_mode">
    <option>in</option>
    <option>not</option>
   </select>
   <select name="x{$BASEID}_content_type">
    <option value="0">{"All content types"|translate}</option>
    {foreach from=$CONTENT_TYPES item=CONTENT_TYPE}
    <option value="{$CONTENT_TYPE.id}">{$CONTENT_TYPE.title|translate}</option>
    {/foreach}
   </select>
  </td>
  <td style="padding-left:3px;"><img src="{$XT_IMAGES}icons/view.png" alt="" /></td>
 </tr>
</table>
</form>