<form method="post" name="editBooking">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Room"|translate}:</span> <span class="title">{$ROOM.title}</span><br />
   {"Display entries from"|translate} {$DATERANGE.0|date_format} - {$DATERANGE.1|date_format} <br />
   {"Entries in"|translate} {"week"|translate}:{$COUNTS.week}, {"month"|translate}:{$COUNTS.month}, {"year"|translate}:{$COUNTS.year}
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}
{foreach from=$BOOKINGS item=ENTRY}
<div style="float:left; margin:5px; padding:5px; border:1px solid #CCCCCC; width:150px;">
<h2>{$ENTRY.title}</h2>
<b>{$ENTRY.date_from|date_format:"%d.%m.%Y %H:%M"}<br />
{$ENTRY.date_to|date_format:"%d.%m.%Y %H:%M"}</b> <br />

{actionIcon action="editBooking"
id=$ENTRY.id
room_id=$ENTRY.room_id
form="0"
icon="edit_small.png"
title="edit"}{actionIcon action="deleteBooking"
id=$ENTRY.id
form="0"
icon="delete.png"
title="edit"
ask="Delete Booking?"
}
<br />
 <a href="mailto:{$ENTRY.email}">{$ENTRY.username}</a>
{"room id"|translate} {$ENTRY.room_id}
</div>
{/foreach}
<input type="hidden" name="autorefresh" value="true" />
{include file="ch.iframe.snode.roombooking/admin/hiddenValues.tpl"}
</form>
