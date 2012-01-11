<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="edit" onSubmit="window.document.forms['edit'].x{$BASEID}_yoffset.value= window.pageYOffset;">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Assessment"|translate}:</span>
   <span class="title">{$xt8200_admin.assessment.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
 	<td class="left">{"Title"|translate}</td>
    <td class="right"><input type="text" name="x{$BASEID}_title" value="{$xt8200_admin.assessment.title}" size="42" /></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="4" cols="65">{$xt8200_admin.assessment.description}</textarea></td>
 </tr>
 {if $DISPLAY.relations}
 {include file="includes/widgets/relations.tpl" cid=$xt8200_admin.assessment.id ctitle=$xt8200_admin.assessment.title}
{/if}
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Questions"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
 {include file="includes/buttons.tpl" data=$xt8200_admin.questionListButtons withouthidden="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header">{"Position"|translate}</td>
  <td class="table_header">{"Options"|translate}</td>
  <td class="table_header">{"Title"|translate}</td>
 </tr>
 {foreach from=$xt8200_admin.questions item=ELEMENT name=E}
 <tr>
  <td class="left" style="padding: 4px; padding-top: 5px; width: 50px;">{$ELEMENT.position}</td>
  <td class="right" style="padding: 4px; padding-top: 5px; width: 100px;">
  {if $xt8200_admin.ctrl_add == 1}{actionIcon
      action="insertQuestion"
      icon="explorer/arrow_down_green.png"
      position="after"
      form="edit"
      yoffset=true
      insert_position=$ELEMENT.position
      title="Insert question after this question"
  }{actionIcon
      action="insertQuestion"
      icon="explorer/arrow_up_green.png"
      position="before"
      form="edit"
      yoffset=true
      insert_position=$ELEMENT.position
      title="Insert question before this question"
  }{else}{actionIcon
      action="editQuestion"
      icon="pencil.png"
      form="edit"
      yoffset=true
      question_id=$ELEMENT.id
      title="Edit question"
  }{actionIcon
      action="deleteQuestion"
      icon="delete.png"
      form="edit"
      yoffset=true
      question_id=$ELEMENT.id
      ask="Are you sure you want to delete this question?"
      title="Delete question"
  }{if !$smarty.foreach.E.first}{actionIcon
      action="moveQuestion"
      icon="explorer/arrow_up_green.png"
      position="up"
      form="edit"
      yoffset=true
      move_position=$ELEMENT.position
      question_id=$ELEMENT.id
      title="Move question up"
  }{else}<img src="{$XT_IMAGES}spacer.gif" width="18" alt=""/>{/if}
  {if !$smarty.foreach.E.last}{actionIcon
      action="moveQuestion"
      icon="explorer/arrow_down_green.png"
      position="down"
      form="edit"
      yoffset=true
      move_position=$ELEMENT.position
      question_id=$ELEMENT.id
      title="Move question down"
  }{/if}{/if}</td>
  <td class="right">{$ELEMENT.title}&nbsp;</td>
 </tr>	
 {/foreach}
</table>
{include file="includes/buttons.tpl" data=$xt8200_admin.solutionListButtons withouthidden="1"}
 {foreach from=$xt8200_admin.solutions item=ELEMENT name=E}
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Solution"|translate}:</span>
   <span class="title">{$ELEMENT.title} ({$ELEMENT.lower_level} - {$ELEMENT.upper_level})</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
   <tr>
 	<td class="left">{"Title"|translate}</td>
    <td class="right"><input type="text" name="x{$BASEID}_solution_title_{$ELEMENT.id}" value="{$ELEMENT.title}" size="42" /></td>
 </tr>
<tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="solution_description_`$ELEMENT.id`"}
  <textarea id="x{$BASEID}_solution_description_{$ELEMENT.id}" name="x{$BASEID}_solution_description_{$ELEMENT.id}" rows="4" cols="65">{$ELEMENT.description}</textarea></td>
 </tr>
  <tr>
 	<td class="left">{"Lower level"|translate}</td>
    <td class="right"><input type="text" name="x{$BASEID}_solution_lower_level_{$ELEMENT.id}" value="{$ELEMENT.lower_level}" size="8" /></td>
 </tr>
   <tr>
 	<td class="left">{"Upper level"|translate}</td>
    <td class="right"><input type="text" name="x{$BASEID}_solution_upper_level_{$ELEMENT.id}" value="{$ELEMENT.upper_level}" size="8" /></td>
 </tr>
 <tr>
  <td class="left">{"Options"|translate}</td>
  <td class="right">
 {actionIcon
      action="deleteAnswer"
      icon="delete.png"
      form="edit"
      yoffset=true
      answer_id=$ELEMENT.id
      ask="Are you sure you want to delete this answer?"
      title="Delete answer"
  }</td>
 </tr>
 </table>
 {/foreach}
 {if $xt8200_admin.solutions|@count > 0}
 {include file="includes/buttons.tpl" data=$xt8200_admin.solutionListButtons withouthidden="1"}
 {/if}
{include file="includes/editor.tpl"}
<input type="hidden" name="x{$BASEID}_id" value="{$xt8200_admin.assessment.id}" />
<input type="hidden" name="x{$BASEID}_question_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_insert_position" value="" />
<input type="hidden" name="x{$BASEID}_move_position" value="" />
{yoffset}
</form>