<form method="POST">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="45">&nbsp;</td>
  <td class="table_header">{"Title"|translate}</td>
 </tr>
 {foreach from=$ROOMS item=ROOM}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{
  actionIcon
      action="editRoom"
      form="0"
      target="slave1"
      icon="pencil.png"
      title="Edit this room"
      room_id=$ROOM.id
  }{
  actionIcon
      action="deleteRoom"
      form="1"
      perm="deleteRooms"
      icon="delete.png"
      room_id=$ROOM.id
      title="Delete this room"
      ask="Are you sure you want to delete this room?"
  }</td>
  <td class="row">{
  actionLink
      action="listBooking"
      form="0"
      target="slave1"
      room_id=$ROOM.id
      title=$ROOM.title
      text=$ROOM.title
  }&nbsp;</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_room_id" />
</form>
