{literal}
<script language="JavaScript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="fieldgroups_edit" onSubmit="document.forms['fieldgroups_edit'].x{$BASEID}_yoffset.value= window.pageYOffset;">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Group"|translate}:</span><span class="title"> {$GROUP.name}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$FIELDGROUPS_EDIT_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="fieldgroups_edit" action="saveFieldgroup"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"fieldname"|translate}</td>
  <td class="right"><input type="text" style="font-weight:bold;" size="42" name="x{$BASEID}_name" value="{$GROUP.name}"></td>
 </tr>
 <tr>
  <td class="left">{"description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="4" cols="65">{$GROUP.description}</textarea>
 </tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Add Property"|translate}<a name="addProperties">&nbsp;</a></span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"add properties"|translate}</td>
  <td class="right">
  <select name=x{$BASEID}_property_id>
    {html_options options=$FIELDNAMES}
  </select>
  <a href="javascript:document.forms['fieldgroups_edit'].x{$BASEID}_action.value='addPropertyToGroup'; document.forms['fieldgroups_edit'].submit();">
   <img src="images/icons/breakpoint_add.png" alt="{"add property"|translate}" title="{"add property"|translate}" />
  </a>
  </td>
</tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Properties"|translate}<a name="additionalProperties">&nbsp;</a></span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
{foreach from=$ARTICLEFIELDS item=FIELD}
 <tr>
  <td class="left" colspan="2">
  <a href="javascript:
  if(confirm('{'q_delete_property'|translate}'))
   document.forms['fieldgroups_edit'].x{$BASEID}_field_id.value={$FIELD.field_id};
   document.forms['fieldgroups_edit'].x{$BASEID}_action.value='deletePropertyFromGroup';
   document.forms['fieldgroups_edit'].x{$BASEID}_yoffset.value= window.pageYOffset;
   document.forms['fieldgroups_edit'].submit();">
  <img src="images/icons/delete.png" align="right" alt="{"delete property"|translate}" title="{"delete property"|translate}" /></a>
  <span title="Position {$FIELD.position}"><b>{$FIELD.title}</b><br />
   {$FIELD.description}</span>
  </td>
 </tr>
{/foreach}
 </table>
 <input type="hidden" name="x{$BASEID}_field_id" value="">
 <input type="hidden" name="x{$BASEID}_id" value="{$GROUP.id}">
 <input type="hidden" name="x{$BASEID}_fieldgroup_id" value="{$GROUP.id}">
 <input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}">
 {yoffset}
</form>
{include file="includes/editor.tpl"}