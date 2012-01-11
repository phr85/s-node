<form method="post" name="overview" action="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;tabs=1">
{include file="ch.iframe.snode.autopilot/admin/hiddenValues.tpl"}
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header" width="25">ID</td>
  <td class="table_header">{"Title"|translate}</td>
 </tr>
 {foreach from=$SLIDES item=SLIDE}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{
  actionIcon
      action="editSlideShow"
      form="0"
      target="slave1"
      icon="pencil.png"
      title="Edit this slideshow"
      slide_id=$SLIDE.id
  }
  {if $SLIDE.active == 1
      }{actionIcon
            action="deactivateSlideShow"
            icon="active.png"
            form="overview"
            slide_id=$SLIDE.id
            title="Deactivate this slideshow"
  }{else
      }{actionIcon 
            action="activateSlideShow"
            icon="inactive.png"
            form="overview"
            slide_id=$SLIDE.id
            title="Activate this slideshow"
  }{/if}{
  actionIcon
      action="deleteSlideShow"
      form="overview"
      icon="delete.png"
      slide_id=$SLIDE.id
      title="Delete this slideshow"
      ask="Are you sure you want to delete this slide?"
  }</td>
  <td class="row">{$SLIDE.id}</td>
  <td class="row">{
  actionLink
      action="editSlideShow"
      form="0"
      target="slave1"
      slide_id=$SLIDE.id
      title=$SLIDE.title
      text=$SLIDE.title
  }&nbsp;</td>
 </tr>
 {/foreach}
</table>
</form>
