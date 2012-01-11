<form method="POST" name="edit">
{include file="ch.iframe.snode.autopilot/admin/hiddenValues.tpl"}
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Slide"|translate}:</span> <span class="title">{$SLIDE.position}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>


 <tr>
  <td class="left">{"Page type"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_page_type" onChange="document.forms[0].x{$BASEID}_action.value='saveSingleSlide';document.forms[0].submit();">
    <option value="0" {if $SLIDE.page_type == "0"}selected{/if}>{"External"|translate}</option>
    <option value="1" {if $SLIDE.page_type == "1"}selected{/if}>{"Internal"|translate}</option>
    <option value="2" {if $SLIDE.page_type == "2"}selected{/if}>{"No Display"|translate}</option>
   </select>
  </td>
 </tr>
 {if $SLIDE.page_type == 0}
 <tr>
  <td class="left">{"Page"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_page" size="42" value="{$SLIDE.page}"></td>
 </tr>
 {/if}
 {if $SLIDE.page_type == 1}
 <tr>
  <td class="left">{"Page"|translate}</td>
  <td class="right">
  <a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL=131&field=x{$BASEID}_page&form=edit',960,500);">
<img src="images/icons/breakpoint_add.png" {"Please select a page"|alttag}></a>
<input type="hidden" name="x{$BASEID}_page_title" size="60" disabled value="{$PAGES[$SLIDE.page][title]}">

 <input type="text" name="x{$BASEID}_page" size="42" value="{$SLIDE.page|htmlspecialchars}">


  </td>
 </tr>
 {/if}

 <tr>
  <td class="left">{"Comment"|translate}</td>
  <td class="right">{toggle_editor id="comment"}
  <textarea id="x{$BASEID}_comment" name="x{$BASEID}_comment" rows="4" cols="65">{$SLIDE.comment}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Duration"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_duration" size="4" value="{$SLIDE.duration|htmlspecialchars}"></td>
 </tr>

</table>

{include file="includes/editor.tpl"}
</form>
