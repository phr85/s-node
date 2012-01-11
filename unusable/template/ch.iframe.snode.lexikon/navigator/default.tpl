{if $NAVIGATOR.prev == true}
<a href="{$smarty.server.PHP_SELF}?TPL={get_param param="target_tpl"}&x{$BASEID}_article_id={$NAVIGATOR.prev_id}" title="{$NAVIGATOR.prev_title}">
...
</a> |
{/if}
{foreach from=$PRODUCTS name=p item=PRODUCT}
{if $NAVIGATOR.position == $PRODUCT.position}<b>{/if}
<a href="{$smarty.server.PHP_SELF}?TPL={get_param param="target_tpl"}&x{$BASEID}_article_id={$PRODUCT.id}" title="{$PRODUCT.title}">{$PRODUCT.position}</a>{if $NAVIGATOR.position == $PRODUCT.position}</b>{/if}
{if !$smarty.foreach.p.last} | {/if}
{/foreach}
{if $NAVIGATOR.next == true}
 |
<a href="{$smarty.server.PHP_SELF}?TPL={get_param param="target_tpl"}&x{$BASEID}_article_id={$NAVIGATOR.next_id}" title="{$NAVIGATOR.next_title}">
...
</a>
{/if}
