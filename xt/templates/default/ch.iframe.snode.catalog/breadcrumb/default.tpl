{if sizeof($WAY) > 0}
{foreach from=$WAY key=KEY name=WAY item=ENTRY}
{if $smarty.foreach.WAY.last}
> {$ENTRY.title}
{else}
<a class="breadbar" href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&amp;x{$BASEID}_node_id={$ENTRY.id}">
> {$ENTRY.title}</a>
{/if}
{/foreach}
{/if}