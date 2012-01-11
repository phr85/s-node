<div class="titlebar">
<a href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&x{$BASEID}_recipe_id={$NAVIGATOR.first_id}" title="{$NAVIGATOR.first_title}">
&laquo;</a> |
{if $NAVIGATOR.prev_id}
<a href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&x{$BASEID}_recipe_id={$NAVIGATOR.prev_id}" title="{$NAVIGATOR.prev_title}">
&lsaquo;</a> |
{/if}
{if $NAVIGATOR.prev_block == true}
<a href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&x{$BASEID}_recipe_id={$NAVIGATOR.prev_block_id}" title="{$NAVIGATOR.prev_block_title}">
...
</a> |
{/if}
{foreach from=$PRODUCTS name=p item=PRODUCT}
<a {if $NAVIGATOR.position == $PRODUCT.position}style="color:#000000;"{/if} href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&x{$BASEID}_recipe_id={$PRODUCT.id}" title="{$PRODUCT.title}">{$PRODUCT.position}</a>
{if !$smarty.foreach.p.last} | {/if}
{/foreach}
{if $NAVIGATOR.next_block == true}
 |
<a href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&x{$BASEID}_recipe_id={$NAVIGATOR.next_block_id}" title="{$NAVIGATOR.next_block_title}">
...
</a>
{/if}
{if $NAVIGATOR.next_id}
| <a href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&x{$BASEID}_recipe_id={$NAVIGATOR.next_id}" title="{$NAVIGATOR.next_title}">
 &rsaquo; </a>
 {/if}
| <a href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&x{$BASEID}_recipe_id={$NAVIGATOR.last_id}" title="{$NAVIGATOR.last_title}">
 &raquo;</a>
</div>
