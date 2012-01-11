{if $GALLERY.page_count > 1}
<div style="clear: both;">
{if $GALLERY.active_page > 1 && $GALLERY.page_count > 1}
<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_page=1"><img src="/images/default/arrow_double_left.gif" alt="" /></a>
{/if}
{if $GALLERY.active_page > 1 && $GALLERY.page_count > 1}
<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_page={$GALLERY.active_page-1}&amp;x{$BASEID}_id={$GALLERY.id}"><img src="/images/default/arrow_left.gif" alt="" /></a>
{/if}
{foreach from=$GALLERY.pages item=PAGE}
 {if $GALLERY.active_page == $PAGE}
  <b>{$PAGE}</b>
 {else}
  <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_page={$PAGE}&amp;x{$BASEID}_id={$GALLERY.id}">{$PAGE}</a>
 {/if}
{/foreach}
{if $GALLERY.page_count > $GALLERY.active_page}
<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_page={$GALLERY.active_page+1}&amp;x{$BASEID}_id={$GALLERY.id}"><img src="/images/default/arrow_right.gif" alt="" /></a>
{/if}
{if $GALLERY.page_count > $GALLERY.active_page}
<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_page={$GALLERY.page_count}&amp;x{$BASEID}_id={$GALLERY.id}"><img src="/images/default/arrow_double_right.gif" alt="" /></a>
{/if}
</div>
{/if}