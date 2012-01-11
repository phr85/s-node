{if $xt7600_trackback_viewer|@count > 0}
<form action="{$smarty.server.REQUEST_URI}" method="post" name="trackback_viewer">
<h3>{"Trackbacks"|livetranslate}</h3>
{foreach from=$xt7600_trackback_viewer item=TRACKBACK}
<div class="comment">
<div class="comment_head">{$TRACKBACK.blog_name} - {$TRACKBACK.title}</div>
<div class="comment_date">{$TRACKBACK.date|date_format}</div>
<div class="comment_body">
{$TRACKBACK.excerpt|truncate:100:"...":true}
</div>
<div class="comment_footer">
{if "moderate"|permcheck}
    {actionIcon action="deleteTrackback" icon=delete.png perm=modereate form=trackback_viewer trackback_id=$TRACKBACK.id}
    {if $TRACKBACK.active == 1}
    {actionIcon action="deactivateTrackback" icon=active.png perm=modereate form=trackback_viewer trackback_id=$TRACKBACK.id}
    {else}
    {actionIcon action="activateTrackback" icon=inactive.png perm=modereate form=trackback_viewer trackback_id=$TRACKBACK.id}
    {/if}
{/if}
</div>
</div>
{/foreach}	
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_trackback_id" value="" />
</form>
{/if}