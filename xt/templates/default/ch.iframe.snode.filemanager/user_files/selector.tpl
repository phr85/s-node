<fieldset class="full"><legend>{"your images"|translate}</legend>
{foreach from=$DATA item="image"}
<div class="userimg">
<div>
<a href="javascript:window.opener.document.forms['create']['x5700_image_id'].value={$image.id};
window.opener.document.forms['create']['x5700_image'].src='/download.php?file_id={$image.id}&file_version=2';
window.close();">
<img src="/images/icons/check.png" alt="select" /></a>
</div>

<a href="/download.php?file_id={$image.id}&amp;file_version=4&amp;lw=is.jpg" class="thickbox"  rel="lightbox[1]" title="">
{image id=$image.id version=cube}
</a>
</div>
{/foreach}
<form name="pm_userimage" action="index.php?TPL={$TPL}" method="post">
<input type="hidden" value="" name="x{$BASEID}_action" />
<input type="hidden" value="" name="x{$BASEID}_id" />
</form>
</fieldset>