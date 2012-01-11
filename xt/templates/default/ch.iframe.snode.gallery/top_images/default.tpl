<h1>{"Top"|translate} {$COUNT} {"Images"|translate}</h1><br />
{foreach from=$IMAGES key=RANK item=IMAGE name=TOP}
{$RANK+1}. <a href="{$smarty.server.PHP_SELF}?TPL={$GALLERY_TPL}&amp;x{$BASEID}_view={$IMAGE.file_id}&amp;x{$BASEID}_id={$IMAGE.gallery_id}">{$IMAGE.title|default:"untitled"}</a> ({$IMAGE.views} {"Views"|translate})<br />
{/foreach}
<br />