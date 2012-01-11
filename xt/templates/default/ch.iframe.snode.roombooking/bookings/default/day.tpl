{foreach from=$BOOKINGS item=ENTRY}
<div style="margin:5px; padding:5px; border:1px solid #CCCCCC;">
[{$ENTRY.date_from|date_format:"%H:%M"}-{ $ENTRY.date_to|date_format:"%H:%M"}]
<span class="title_light">{$ENTRY.title}</span> 
<hr />
<div>{$ENTRY.comment}</div>
<br clear="all">
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

<b><a href="mailto:{$ENTRY.email}">{$ENTRY.username}</a></b>
{"created"|translate} <b>{$ENTRY.creation_date|date_format:"%d.%m.%Y %H:%M"}</b>
{"modified"|translate} <b>{$ENTRY.mod_date|date_format:"%d.%m.%Y %H:%M"}</b>
</div>
{/foreach}
