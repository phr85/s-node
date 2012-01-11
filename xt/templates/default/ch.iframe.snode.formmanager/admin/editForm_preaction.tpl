<table cellspacing="0" cellpadding="0" width="100%">
<tr>
  <td class="view_header" colspan="4">
   <span class="title">{"PreActions"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_FORM_PREACTIONS_BUTTONS withouthidden="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 {foreach from=$PREACTIONS item=PREACTION name=A}
 <tr>
  <td class="left">{$PREACTION.pos}. {$PREACTION.label|truncate:24:"...":true}&nbsp;</td>
  <td class="right" style="padding: 4px; padding-top: 5px; width: 80px;">{if $CTRL_PREACTION
  }{actionIcon
      action="insertPreAction"
      icon="explorer/arrow_down_green.png"
      position="after"
      form="editForm"
      yoffset=true
      insert_position=$PREACTION.pos
      title="Insert PreAction after this PreAction"
  }{actionIcon
      action="insertPreAction"
      icon="explorer/arrow_up_green.png"
      position="before"
      form="editForm"
      yoffset=true
      insert_position=$PREACTION.pos
      title="Insert PreAction before this PreAction"
  }{else}{actionIcon
      action="editPreAction"
      icon="pencil.png"
      form="editForm"
      yoffset=true
      preaction_id=$PREACTION.id
      title="Edit PreAction"
  }{actionIcon
      action="deletePreAction"
      icon="delete.png"
      form="editForm"
      yoffset=true
      preaction_id=$PREACTION.id
      ask="Are you sure you want to delete this form element?"
      title="Delete PreAction"
  }{if !$smarty.foreach.A.last}{actionIcon
      action="movePreAction"
      icon="explorer/arrow_down_green.png"
      position="down"
      form="editForm"
      yoffset=true
      move_position=$PREACTION.pos
      preaction_id=$PREACTION.id
      title="Move PreAction down"
  }{else}{$ICONSPACER}{/if}{if !$smarty.foreach.A.first}{actionIcon
      action="movePreAction"
      icon="explorer/arrow_up_green.png"
      position="up"
      form="editForm"
      yoffset=true
      move_position=$PREACTION.pos
      preaction_id=$PREACTION.id
      title="Move PreAction up"
  }{else}{$ICONSPACER}{/if}{/if}</td>
  <td class="right">{$PREACTION.value}&nbsp;</td>
 </tr>
 {/foreach}
</table>