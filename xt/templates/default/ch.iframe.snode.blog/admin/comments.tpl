<form method="POST" name="commenttable">
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="81">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header" width="50">{"Title"|translate}</td>
   <td class="table_header" width="50">{"Date"|translate}</td>
   <td class="table_header">{"Comment"|translate}</td>
  </tr>
  {foreach from=$DATA item=COMMENT name=COMMENTTABLE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if "edit"|allowed}
       {if $COMMENT.active == 1}{
       actionIcon
           action="deactivateComment"
           form="commenttable"
           icon="active.png"
           title="deactivate this address"
           perm="edit"
           comment_id=$COMMENT.id
       }{else}{
       actionIcon
           action="activateComment"
           form="commenttable"
           icon="inactive.png"
           title="activate this address"
           perm="edit"
           comment_id=$COMMENT.id
       }{/if}
       {/if}
       {if "delete"|allowed}
       {if $ADDRESS.active == 0}{
       actionIcon
           action="deleteComment"
           icon="delete.png"
           title="Delete this user"
           perm="edit"
           comment_id=$COMMENT.id
           ask="Are you sure to delete this comment?"
           form="commenttable"
       }{/if}
       {/if}</td>
       <td class="row">{$COMMENT.id}&nbsp;</td>
       <td class="row">{$COMMENT.title}&nbsp;</td>
       <td class="row">{$COMMENT.c_date|date_format:"%d.%m.%Y %H:%M"}&nbsp;</td>
       <td class="row">
	{$COMMENT.name}&nbsp;(<a href="mailto:{$COMMENT.email}">{$COMMENT.email}</a>)<br/>{$COMMENT.comment|truncate:100:"..."}

      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="commenttable"}
 <input type="hidden" name="x{$BASEID}_comment_id" value="" />
 <input type="hidden" name="x{$BASEID}_action" value="" />
</form>