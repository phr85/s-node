<form method="POST" name="edit">
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Parameters"|translate}&nbsp;</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">
  <select name="x{$BASEID}_param">
    {foreach from=$PARAMS item=PARAM}
    <option value="{$PARAM.id}">{$PARAM.name}</option>
    {/foreach}
  </select>
  &nbsp;</td>
  <td class="right"><input type="text" name="x{$BASEID}_value" value="" size="42"></td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_feed_id" value="{$feed_id}" />
<input type="hidden" name="x{$BASEID}_profile" value="{$profile}" />
</form>