{literal}
<script language="JavaScript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form method="POST" name="editForm">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Form"|translate}:</span><span class="title"> {$DATA.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_FORM_BUTTONS yoffset=true}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" value="{$DATA.title|htmlspecialchars}" size="42">
  <input type="checkbox" name="x{$BASEID}_hide_label" value="1" {if $DATA.hide_label==1} checked="checked" {/if} />{"hide label"|translate}
  </td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="6" cols="65">{$DATA.description}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Choose layout"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_layout" value="{if $DATA.layout == ''}default.tpl{else}{$DATA.layout}{/if}" size="42"></td>
  </td>
 </tr>
 <tr>
  <td class="left">{"Identifier"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_identifier" value="{$DATA.identifier}" size="42"></td>
  </td>
 </tr>
{if $DISPLAY.relations}
 {include file="includes/widgets/relations.tpl" cid=$DATA.id ctitle=$DATA.title}
{/if}
{if $DISPLAY.properties}
 {include file="includes/widgets/properties.tpl" content_id=$DATA.id content_type=$BASEID formname="editForm" nogroups=true}
{/if}
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Fields"|translate}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_FORM_ELEMENTS_BUTTONS withouthidden="1" yoffset=true}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header">{"Elements"|translate}</td>
  <td class="table_header">{"Options"|translate}</td>
  <td class="table_header">{"Field type"|translate}</td>
  <td class="table_header" width="120">{"Scripting Identifier"|translate}</td>
 </tr>
 {foreach from=$ELEMENTS item=ELEMENT name=E}
 <tr>
  <td class="left" style="{if $ELEMENT.element_type_id == 8}border-bottom: 1px solid black; color: black; font-weight: bold;{/if}">{$ELEMENT.pos}. {if $ELEMENT.required}<b>{/if}{$ELEMENT.label|truncate:24:"...":true}{if $ELEMENT.required}</b>{/if}&nbsp;</td>
  <td class="right" style="padding: 4px; padding-top: 5px; width: 80px; {if $ELEMENT.element_type_id == 8}border-bottom: 1px solid black;{/if}{if $II > 0}padding-left:30px;{/if} ">{
  if $CTRL
  }{actionIcon
      action="insertElement"
      icon="explorer/arrow_down_green.png"
      position="after"
      form="editForm"
      yoffset=true
      insert_position=$ELEMENT.pos
      title="Insert element after this element"
  }{actionIcon
      action="insertElement"
      icon="explorer/arrow_up_green.png"
      position="before"
      form="editForm"
      yoffset=true
      insert_position=$ELEMENT.pos
      title="Insert element before this element"
  }{else}{actionIcon
      action="editElement"
      icon="pencil.png"
      form="editForm"
      yoffset=true
      element_id=$ELEMENT.element_id
      title="Edit element"
  }{actionIcon
      action="deleteElement"
      icon="delete.png"
      form="editForm"
      yoffset=true
      element_id=$ELEMENT.element_id
      ask="Are you sure you want to delete this form element?"
      title="Delete element"
  }{if !$smarty.foreach.E.last}{actionIcon
      action="moveElement"
      icon="explorer/arrow_down_green.png"
      position="down"
      form="editForm"
      yoffset=true
      move_position=$ELEMENT.pos
      element_id=$ELEMENT.element_id
      title="Move element down"
  }{else}{$ICONSPACER}{/if}{if !$smarty.foreach.E.first}{actionIcon
      action="moveElement"
      icon="explorer/arrow_up_green.png"
      position="up"
      form="editForm"
      yoffset=true
      move_position=$ELEMENT.pos
      element_id=$ELEMENT.element_id
      title="Move element up"
  }{else}{$ICONSPACER}{/if}{/if}</td>
  <td class="right" style="{if $ELEMENT.element_type_id == 8}border-bottom: 1px solid black;{/if}">{$ELEMENT.element_type}&nbsp;</td>
  <td class="right" style="{if $ELEMENT.element_type_id == 8}border-bottom: 1px solid black;{/if}">{$ELEMENT.scripting_identifier}&nbsp;</td>
 </tr>
 {if $ELEMENT.element_type_id == 6 && $ELEMENT.size > 1 }
 {counter start=$ELEMENT.size direction="down" print=false assign="II" }
 {assign var="GROUPWIDTH" value=$ELEMENT.size}
 {assign var="ISCOUNTING" value="1"}
 {elseif $ISCOUNTING == 1}
 {counter}
 {else}
 {assign var="ISCOUNTING" value="0"}
 {assign var="II" value="0"}
 {/if}
 {/foreach}
 <tr>
 <td colspan="4">{include file="includes/buttons.tpl" data=$EDIT_FORM_BUTTONS withouthidden="1" yoffset=true}</td>
 </tr>

 <tr>
  <td class="view_header" colspan="4">
   <span class="title">{"Actions"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_FORM_ACTIONS_BUTTONS withouthidden="1" yoffset=true}
<table cellspacing="0" cellpadding="0" width="100%">
 {foreach from=$ACTIONS item=ACTION name=A}
 <tr>
  <td class="left">{$ACTION.pos}. {$ACTION.label|truncate:24:"...":true}&nbsp;</td>
  <td class="right" style="padding: 4px; padding-top: 5px; width: 80px;">{
  if $CTRL_ACTION
  }{actionIcon
      action="insertAction"
      icon="explorer/arrow_down_green.png"
      position="after"
      form="editForm"
      yoffset=true
      insert_position=$ACTION.pos
      title="Insert action after this action"
  }{actionIcon
      action="insertAction"
      icon="explorer/arrow_up_green.png"
      position="before"
      form="editForm"
      yoffset=true
      insert_position=$ACTION.pos
      title="Insert action before this action"
  }{else}{actionIcon
      action="editAction"
      icon="pencil.png"
      form="editForm"
      yoffset=true
      action_id=$ACTION.id
      title="Edit action"
  }{actionIcon
      action="deleteAction"
      icon="delete.png"
      form="editForm"
      yoffset=true
      action_id=$ACTION.id
      ask="Are you sure you want to delete this form element?"
      title="Delete action"
  }{if !$smarty.foreach.A.last}{actionIcon
      action="moveAction"
      icon="explorer/arrow_down_green.png"
      position="down"
      form="editForm"
      yoffset=true
      move_position=$ACTION.pos
      action_id=$ACTION.id
      title="Move action down"
  }{else}{$ICONSPACER}{/if}{if !$smarty.foreach.A.first}{actionIcon
      action="moveAction"
      icon="explorer/arrow_up_green.png"
      position="up"
      form="editForm"
      yoffset=true
      move_position=$ACTION.pos
      action_id=$ACTION.id
      title="Move action up"
  }{else}{$ICONSPACER}{/if}{/if}</td>
  <td class="right">{$ACTION.value}&nbsp;</td>
 </tr>
 {/foreach}
</table>
{include file="ch.iframe.snode.formmanager/admin/editForm_preaction.tpl"}
<input type="hidden" name="x{$BASEID}_element_id" value="" />
<input type="hidden" name="x{$BASEID}_action_id" value="" />
<input type="hidden" name="x{$BASEID}_preaction_id" value="" />
<input type="hidden" name="x{$BASEID}_insert_position" value="" />
<input type="hidden" name="x{$BASEID}_move_position" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_form_id" />
<input type="hidden" name="x{$BASEID}_script_id" />
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}" />
{yoffset}
</form>
{include file="includes/editor.tpl"}
