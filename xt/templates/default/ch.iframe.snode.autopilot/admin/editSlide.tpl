{literal}
<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
{/literal}
<form method="POST" name="edit">
{include file="ch.iframe.snode.autopilot/admin/hiddenValues.tpl"}
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Slideshow"|translate}:</span> <span class="title">{$SLIDESHOW.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$SLIDESHOW.title|htmlspecialchars}"></td>
 </tr>

 <tr>
  <td class="left">{"Random mode?"|translate}</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_random" value="1" {if $SLIDESHOW.random == 1}checked{/if}>
  </td>
 </tr>

 <tr>
  <td class="left">{"Loop mode?"|translate}</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_loop" value="1" {if $SLIDESHOW.loop == 1}checked{/if}>
  </td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="4" cols="65">{$SLIDESHOW.description}</textarea></td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Slides"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONS_SLIDE withouthidden="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="120">{"Options"|translate}</td>
  <td class="table_header">{"Page"|translate}</td>
  <td class="table_header" width="50">{"Duration"|translate}</td>

 </tr>
 {foreach from=$SLIDES name=slider item=SLIDE}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button" valign="top">
  {
  actionIcon
      action="editSlide"
      form="edit"
      icon="pencil.png"
      title="Edit this slide"
      slide_id=$SLIDE.id
      position=$SLIDE.position
  }
  {if $SLIDE.active == 1
      }{actionIcon
            action="deactivateSlide"
            icon="active.png"
            form="edit"
            slide_id=$SLIDE.id
            position=$SLIDE.position
            title="Deactivate this slide"
  }{else
      }{actionIcon
            action="activateSlide"
            icon="inactive.png"
            form="edit"
            slide_id=$SLIDE.id
            position=$SLIDE.position
            title="Activate this slide"
  }{/if}

  {if !$smarty.foreach.slider.last}{actionIcon
      action="moveElement"
      icon="explorer/arrow_down_green.png"
      position=$SLIDE.position
      direction="down"
      form="edit"
      slide_id=$SLIDE.id
      title="Move element down"
  }{else}{$ICONSPACER}{/if}
  {if !$smarty.foreach.slider.first}{actionIcon
      action="moveElement"
      icon="explorer/arrow_up_green.png"
      position=$SLIDE.position
      direction="up"
      form="edit"
      slide_id=$SLIDE.id
      title="Move element up"
  }{else}{$ICONSPACER}{/if}

  {
  actionIcon
      action="deleteSlide"
      form="edit"
      icon="delete.png"
      slide_id=$SLIDE.id
      position=$SLIDE.position
      title="Delete this slide"
      ask="Are you sure you want to delete this slide?"
  }
  </td>
 <td class="button" valign="top">{$SLIDE.page}{if $SLIDE.page_type==2}{"closed window"|translate}{/if}&nbsp;</td>
  <td class="button" valign="top">{$SLIDE.duration}</td>

   </tr>
 {/foreach}
</table>
{include file="includes/editor.tpl"}
</form>
