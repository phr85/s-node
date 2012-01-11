{if sizeof($WAY) > 1}
{foreach from=$WAY key=KEY name=WAY item=ENTRY}
{if $KEY > 1}
{if $smarty.foreach.WAY.last}
&raquo; {$ENTRY.title}
{else}
&raquo; <a href="{$smarty.server.PHP_SELF}?TPL={$ENTRY.id}">{$ENTRY.title}</a>
{/if}
{/if}
{/foreach}
{/if}