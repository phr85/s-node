<form method="POST" name="trackbacktable">
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="81">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header" width="100">{"Blog name"|translate}</td>
   <td class="table_header" width="50">{"Date"|translate}</td>
   <td class="table_header">{"Comment"|translate}</td>
  </tr>
  {foreach from=$DATA item=TRACKBACK name=TRACKBACKTABLE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if "edit"|allowed}
       {if $TRACKBACK.active == 1}{
       actionIcon
           action="deactivateTrackback"
           form="trackbacktable"
           icon="active.png"
           title="deactivate this address"
           perm="edit"
           trackback_id=$TRACKBACK.id
       }{else}{
       actionIcon
           action="activateTrackback"
           form="trackbacktable"
           icon="inactive.png"
           title="activate this address"
           perm="edit"
           trackback_id=$TRACKBACK.id
       }{/if}
       {/if}
       {if "delete"|allowed}
       {if $ADDRESS.active == 0}{
       actionIcon
           action="deleteTrackback"
           icon="delete.png"
           title="Delete this user"
           perm="edit"
           trackback_id=$TRACKBACK.id
           ask="Are you sure to delete this comment?"
           form="trackbacktable"
       }{/if}
       {/if}</td>
       <td class="row">{$TRACKBACK.id}&nbsp;</td>
       <td class="row">{$TRACKBACK.blog_name}&nbsp;</td>
       <td class="row">{$TRACKBACK.date|date_format:"%d.%m.%Y %H:%M"}&nbsp;</td>
       <td class="row">
	<a href="{$TRACKBACK.source_url}" target="_blank">{$TRACKBACK.title}</a><br/>{$TRACKBACK.excerpt|truncate:100:"..."}

      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="trackbacktable"}
 <input type="hidden" name="x{$BASEID}_trackback_id" value="" />
 <input type="hidden" name="x{$BASEID}_action" value="" />
</form>