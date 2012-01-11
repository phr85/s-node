<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="edit" onSubmit="window.document.forms['edit'].x{$BASEID}_yoffset.value= window.pageYOffset;">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Question"|translate}:</span>
   <span class="title">{$xt8200_admin.question.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
 	<td class="left">{"Title"|translate}</td>
    <td class="right"><input type="text" name="x{$BASEID}_title" value="{$xt8200_admin.question.title}" size="42" /></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="4" cols="65">{$xt8200_admin.question.description}</textarea></td>
 </tr>
</table>
 {include file="includes/buttons.tpl" data=$xt8200_admin.answerListButtons withouthidden="1"}
 {foreach from=$xt8200_admin.answers item=ELEMENT name=E}
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Answer"|translate}  {math equation="x + 1" x=$ELEMENT.position}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
<tr>
  <td class="left">{"Answer"|translate}</td>
  <td class="right">{toggle_editor id="answer_description_`$ELEMENT.id`"}
  <textarea id="x{$BASEID}_answer_description_{$ELEMENT.id}" name="x{$BASEID}_answer_description_{$ELEMENT.id}" rows="4" cols="65">{$ELEMENT.description}</textarea></td>
 </tr>
{if $DISPLAY.quiz_like}
<tr>
  <td class="left">{"Comment"|translate}</td>
  <td class="right">{toggle_editor id="answer_comment_`$ELEMENT.id`"}
  <textarea id="x{$BASEID}_answer_comment_{$ELEMENT.id}" name="x{$BASEID}_answer_comment_{$ELEMENT.id}" rows="4" cols="65">{$ELEMENT.comment}</textarea></td>
 </tr>
{/if}
  <tr>
 	<td class="left">{"Value"|translate}</td>
    <td class="right"><input type="text" name="x{$BASEID}_answer_value_{$ELEMENT.id}" value="{$ELEMENT.value}" size="42" /></td>
 </tr>
 <tr>
  <td class="left">{"Options"|translate}</td>
  <td class="right">
  {if $xt8200_admin.ctrl_add_answer == 1}{actionIcon
      action="insertAnswer"
      icon="explorer/arrow_down_green.png"
      position="after"
      form="edit"
      yoffset=true
      insert_position=$ELEMENT.position
      title="Insert answer after this answer"
  }{actionIcon
      action="insertAnswer"
      icon="explorer/arrow_up_green.png"
      position="before"
      form="edit"
      yoffset=true
      insert_position=$ELEMENT.position
      title="Insert answer before this answer"
  }
  {else}{actionIcon
      action="deleteAnswer"
      icon="delete.png"
      form="edit"
      yoffset=true
      answer_id=$ELEMENT.id
      ask="Are you sure you want to delete this answer?"
      title="Delete answer"
  }{if !$smarty.foreach.E.first}{actionIcon
      action="moveAnswer"
      icon="explorer/arrow_up_green.png"
      position="up"
      form="edit"
      yoffset=true
      move_position=$ELEMENT.position
      answer_id=$ELEMENT.id
      title="Move answer up"
  }{else}<img src="{$XT_IMAGES}spacer.gif" width="18" alt=""/>{/if}
  {if !$smarty.foreach.E.last}{actionIcon
      action="moveAnswer"
      icon="explorer/arrow_down_green.png"
      position="down"
      form="edit"
      yoffset=true
      move_position=$ELEMENT.position
      answer_id=$ELEMENT.id
      title="Move answer down"
  }{/if}{/if}</td>
 </tr>
 </table>

 {/foreach}
 {if $xt8200_admin.answers|@count > 0}
 {include file="includes/buttons.tpl" data=$xt8200_admin.answerListButtons withouthidden="1"}
 {/if}
{include file="includes/editor.tpl"}
<input type="hidden" name="x{$BASEID}_id" value="{$xt8200_admin.id}" />
<input type="hidden" name="x{$BASEID}_question_id" value="{$xt8200_admin.question.id}" />
<input type="hidden" name="x{$BASEID}_answer_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_insert_position" value="" />
<input type="hidden" name="x{$BASEID}_move_position" value="" />
{yoffset}
</form>