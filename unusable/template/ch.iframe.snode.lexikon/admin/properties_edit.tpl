<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="property_edit">
{include file="includes/buttons.tpl" data=$PROPERTIE_EDIT_BUTTONS}
{include file="includes/lang_selector_submit.tpl" form="property_edit" action="saveProperty"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"edit_properties"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"fieldname"|translate}</td>
  <td class="right"><input type="text" size="15" name="x{$BASEID}_fieldname" value="{$DATA.fieldname}"></td>
 </tr>
 <tr>
  <td class="left">{"description"|translate}</td>
  <td class="right">
  <textarea name="x{$BASEID}_description" rows="2" cols="42">{$DATA.description}</textarea>
 </tr>
 <tr>
  <td class="left">{"position"|translate}</td>
  <td class="right"><input type="text" size="15" name="x{$BASEID}_position" value="{$DATA.position}"></td>
 </tr>
 </table>
 <input type="hidden" name="x{$BASEID}_id" value="{$DATA.id}">
 <input type="hidden" name="x{$BASEID}_property_id" value="{$DATA.id}">
</form>
