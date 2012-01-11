<form method="post" name="editBooking">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Room"|translate}:</span> <span class="title">{$ROOM.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}


<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$BOOKING.title|htmlspecialchars}"></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_comment" rows="4" cols="65">{$BOOKING.comment}</textarea></td>
 </tr>
</table>

{include file="ch.iframe.snode.roombooking/admin/time.tpl"}

{if count($COLLISIONS)>0}
<br />
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td colspan="2" style="background-color:#DD3333;color:#FFFFFF;padding:5px;font-size:13px; font-weight:bold;">{"date collision"|translate}</td>
</tr>
<tr>
<td class="left" style="font-weight:bold;">{"Title"|translate}</td>
<td class="right" style="font-weight:bold;">{"Time"|translate}</td>
</tr>
{foreach from=$COLLISIONS item=COLLISION}
 <tr>
  <td class="left">{$COLLISION.title}</td>
  <td class="right">{$COLLISION.date_from|date_format:"%d.%m.%Y <b>%H:%M</b>"} - {$COLLISION.date_to|date_format:"%d.%m.%Y <b>%H:%M</b>"}
  </td>
 </tr>
{/foreach}
</table>
{/if}

{include file="ch.iframe.snode.roombooking/admin/hiddenValues.tpl"}
{include file="includes/editor.tpl"}
</form>
