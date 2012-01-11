<form method="post" name="overview">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header">{"Title"|translate}</td>
 </tr>
 {foreach from=$DATA item=FEED}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{
  actionIcon
      action="editFeed"
      form="0"
      icon="pencil.png"
      perm="edit"
      title="Edit this feed"
      feed_id=$FEED.id
      target="slave1"
  }{actionIcon
      action="deleteFeed"
      form="0"
      icon="delete.png"
      feed_id=$FEED.id
      perm="delete"
      target="slave1"
      title="Delete this feed"
      ask="Are you sure you want to delete this feed?"
   }</td>
  <td class="row">{$FEED.title}&nbsp;</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_feed_id" />
<input type="hidden" name="x{$BASEID}_action" />
{include file="includes/navigator.tpl"}
</form>