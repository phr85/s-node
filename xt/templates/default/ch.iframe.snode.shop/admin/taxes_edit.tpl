<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}&module={$ADMINMODULE}" method="POST" name="units">
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
{include file="includes/lang_selector_submit.tpl" form="units" action="saveTaxes"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Tax"|translate}:</span><span class="title"> {$DATA.value}%</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"value"|translate}</td>
  <td class="right"><input type="text" size="12" name="x{$BASEID}_value" value="{$DATA.value}"></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right"><textarea rows="2" cols="40" name="x{$BASEID}_description">{$DATA.description}</textarea></td>
 </tr>
 </table>
 <input type="hidden" name="x{$BASEID}_id" value="{$DATA.id}">
<br />
</form>
