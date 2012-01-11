{literal}
<script language="JavaScript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="groups_edit" onSubmit="document.forms['groups_edit'].x{$BASEID}_yoffset.value= window.pageYOffset;">
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
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}
{include file="includes/lang_selector_simple.tpl" form="groups_edit" action="saveFieldgroup"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"fieldname"|translate}</td>
  <td class="right"><input type="text" style="font-weight:bold;" size="42" name="x{$BASEID}_title" value="{$GROUP.title}"></td>
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
  <select name=x{$BASEID}_property_id_add>
    {html_options options=$UNASSIGNEDPROPERTIES}
  </select>
  <a href="javascript:document.forms['groups_edit'].x{$BASEID}_action.value='addPropertyToGroup'; document.forms['groups_edit'].submit();">
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
{foreach from=$PROPERTIES item=PROPERTY}
 <tr>
  <td class="left" colspan="2">
  {actionIcon
  action="removePropertyFromGroup"
  icon="delete.png"
  group_id=$GROUP.id
  property_id=$PROPERTY.id
  ask="remove property from group"
  form="groups_edit"
  title="remove property from group"
  yoffset=true
  }

  <span title="Position {$FIELD.position}"><b>{$PROPERTY.title}</b><br />
   {$PROPERTY.description}</span>
  </td>
 </tr>
{/foreach}
 </table>

 {include file="ch.iframe.snode.properties/admin/hiddenValues.tpl"}
</form>
{include file="includes/editor.tpl"}