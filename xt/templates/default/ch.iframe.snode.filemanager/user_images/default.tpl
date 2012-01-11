<fieldset class="full"><legend>{"your images"|translate}</legend>

<div>{"used images can not be deleted"|translate}</div>
{foreach from=$DATA item="image"}
<div class="userimg">{if $image.cnt==0}<div>{actionIcon ask="Delete Image" action="user_deletePrivateFile" icon="delete.png" file_id=$image.id title="delete" form="userimage"}</div>{else}<div style="background-color:#FFFFFF; padding:1px;">{$image.cnt}</div>{/if}
<a href="/download.php?file_id={$image.id}&amp;file_version=3&amp;lw=is.jpg" class="thickbox"  rel="lightbox[1]" title="">
{image id=$image.id version=cube}
</a>
</div>
{/foreach}
<form name="userimage" action="index.php?TPL={$TPL}" method="post">
<input type="hidden" value="" name="x{$BASEID}_action" />
<input type="hidden" value="" name="x{$BASEID}_file_id" />
</form>
<br clear="all" />
</fieldset>