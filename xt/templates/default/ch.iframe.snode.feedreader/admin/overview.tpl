<form method="post" name="overview">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" width="80">{actionIcon action="NULL" label="ID" form=overview sort=$sort.0.value icon=$sort.0.icon}</td>
  <td class="table_header" width="150">{actionIcon action="NULL" form=overview label="Title" sort=$sort.1.value icon=$sort.1.icon}</td>
  <td class="table_header">{actionIcon action="NULL" form=overview label="URL" sort=$sort.2.value icon=$sort.2.icon}</td>
 </tr>
 {foreach from=$DATA item=FEED}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{if $FEED.active == 0}{
  actionIcon
      action="activate"
      form="overview"
      icon="inactive.png"
      perm="changestatus"
      title="Activate this feed"
      feed_id=$FEED.id
  }{else}{
  actionIcon
      action="deactivate"
      form="overview"
      icon="active.png"
      perm="changestatus"
      title="Deactivate this feed"
      feed_id=$FEED.id
  }{/if}{
  actionIcon
      action="updateFeed"
      form="overview"
      icon="refresh.png"
      title="Refresh this feed"
      feed_id=$FEED.id
  }{
  actionIcon
      action="editFeed"
      form="0"
      icon="pencil.png"
      perm="editfeeds"
      title="Edit this feed"
      feed_id=$FEED.id
      target="slave1"
  }{
  actionIcon
      action="delete"
      form="overview"
      icon="delete.png"
      perm="delete"
      title="Delete this feed"
      feed_id=$FEED.id
      ask="Are you sure you want to delete this feed?"
  }{
  actionIcon
      action="viewFeed"
      form="0"
      icon="view.png"
      perm="viewfeeds"
      title="View this feed"
      feed_id=$FEED.id
      target="slave1"
  }
  {
  actionIcon
      action="resetFeed"
      form="0"
      icon="warning.png"
      perm="resetfeeds"
      title="Reset this feed"
      feed_id=$FEED.id
      target="slave1"
  }
  </td>
  <td class="row">{$FEED.title}</td>
  <td class="row">{$FEED.url|truncate:30:"...":true}</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_feed_id" />
<input type="hidden" name="x{$BASEID}_sort" value="" />
</form>