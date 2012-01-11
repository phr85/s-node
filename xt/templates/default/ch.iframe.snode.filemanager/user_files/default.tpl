<fieldset class="full"><legend>{"your files"|translate}</legend>

{foreach from=$DATA item="file"}
<div class="userimg">{if $file.cnt==0}<div>{actionIcon ask="Delete file" action="user_deletePrivateFile" icon="delete.png" file_id=$file.id title="delete" form="userfile"}</div>{else}<div style="background-color:#FFFFFF; padding:1px;">{$file.cnt}</div>{/if}
{if $file.type==1}
<a href="/download.php?file_id={$file.id}&amp;file_version=3&amp;lw=is.jpg" class="thickbox"  rel="lightbox[1]" title="">
{image id=$file.id version=cube}
</a>
{else}
<a href="/download.php?file_id={$file.id}">{$file.filename|icon}</a>
{/if}
</div>
{/foreach}
<form name="userfile" action="index.php?TPL={$TPL}" method="post">
<input type="hidden" value="" name="x{$BASEID}_action" />
<input type="hidden" value="" name="x{$BASEID}_file_id" />
</form>
<br clear="all" />
</fieldset>