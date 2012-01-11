{if sizeof($DATA) > 0}
{foreach from=$DATA item=submap name=sN}
<a class="sitemaplow" href="{$smarty.server.PHP_SELF}?TPL={$submap.id}">{$submap.title}</a>
{/foreach}
{/if}

