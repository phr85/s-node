<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}&module={$ADMINMODULE}" method="POST" name="units">
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
{include file="includes/lang_selector_submit.tpl" form="units" action="save"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Unit"|translate}:</span><span class="title"> {$DATA.standard}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"standard"|translate}</td>
  <td class="right"><input type="text" size="12" name="x{$BASEID}_standard" value="{$DATA.standard}"></td>
 </tr>
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" size="15" name="x{$BASEID}_short" value="{$DATA.short}"></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_full" value="{$DATA.full}"></td>
 </tr>
 </table>
 <input type="hidden" name="x{$BASEID}_id" value="{$DATA.id}">
<br />
</form>
