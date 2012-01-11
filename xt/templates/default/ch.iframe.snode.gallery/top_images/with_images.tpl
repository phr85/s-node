<h1>{"Top"|translate} {$COUNT} {"Images"|translate}</h1><br />
{foreach from=$IMAGES key=RANK item=IMAGE name=TOP}
<div style="clear: both;">
<div style="float: left;">
<a href="{$smarty.server.PHP_SELF}?TPL={$GALLERY_TPL}&amp;x{$BASEID}_view={$IMAGE.file_id}&amp;x{$BASEID}_id={$IMAGE.gallery_id}">{
image
    id=$IMAGE.id
    version=0
    title=$IMAGE.description
    alt=$IMAGE.title
    style="border: 1px solid #DDDDDD; margin-right: 8px;"
}</a></div>
<p style="margin: 0px;">{$RANK+1}. <b><a href="{$smarty.server.PHP_SELF}?TPL={$GALLERY_TPL}&amp;x{$BASEID}_view={$IMAGE.file_id}&amp;x{$BASEID}_id={$IMAGE.gallery_id}">{$IMAGE.title}</a></b><br />({$IMAGE.views} {"Views"|translate})</p><br />
</div>
{/foreach}
<br />