<form method="post" name="overview">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header" width="150">{"Shortcut"|translate}</td>
  <td class="table_header">{"URL"|translate}</td>
 </tr>
 {foreach from=$DATA item=virtual}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{
  actionIcon
      action="editVirtual"
      form="0"
      icon="pencil.png"
      perm="editVirtual"
      title="Edit this Virtual"
      virtual_id=$virtual.id
      target="slave1"
  }{
  actionIcon
      action="deleteVirtual"
      form="overview"
      icon="delete.png"
      perm="deleteVirtual"
      title="Delete this Virtual"
      virtual_id=$virtual.id
      ask="Are you sure you want to delete this virtual?"
  }</td>
  <td class="row">{$virtual.pattern}&nbsp;</td>
  <td class="row">{$virtual.url|truncate:30:"...":true}&nbsp;</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_virtual_id" />
</form>