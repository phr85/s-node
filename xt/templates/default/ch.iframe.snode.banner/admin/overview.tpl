<form method="POST">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header" width="25">ID</td>
  <td class="table_header">{"Title"|translate}</td>
 </tr>
 {foreach from=$ZONES item=ZONE}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{
  actionIcon
      action="editZone"
      form="0"
      target="slave1"
      icon="pencil.png"
      title="Edit this zone"
      zone_id=$ZONE.id
  }{
  actionIcon
      action="deleteZone"
      form="1"
      icon="delete.png"
      zone_id=$ZONE.id
      title="Delete this zone"
      ask="Are you sure you want to delete this zone?"
  }</td>
  <td class="row">{$ZONE.id}</td>
  <td class="row">{
  actionLink
      action="editZone"
      form="0"
      target="slave1"
      zone_id=$ZONE.id
      title=$ZONE.title
      text=$ZONE.title
  }&nbsp;</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_zone_id" />
</form>
