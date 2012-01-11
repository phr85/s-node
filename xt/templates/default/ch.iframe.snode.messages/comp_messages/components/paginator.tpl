<ul class="XTMSGpaginator">
<li><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_page[{$MODE}]={$METADATA.paginator.current_page-1}" rel="&x{$BASEID}_page[{$MODE}]={$METADATA.paginator.current_page-1}">prev</a></li>
<li><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_page[{$MODE}]=1" rel="&x{$BASEID}_page[{$MODE}]=1">first</a></li>
{section name="paginator" loop=$METADATA.paginator.num_of_pages step=1 start=0}
<li {if $METADATA.paginator.current_page == $smarty.section.paginator.iteration}class="selected"{/if}><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_page[{$MODE}]={$smarty.section.paginator.iteration}" rel="&x{$BASEID}_page[{$MODE}]={$smarty.section.paginator.iteration}">[{$smarty.section.paginator.iteration*10-9} - {$smarty.section.paginator.iteration*10}]</a> </li>
{/section}
<li><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_page[{$MODE}]={$METADATA.paginator.num_of_pages}" rel="&x{$BASEID}_page[{$MODE}]={$METADATA.paginator.num_of_pages}">last</a></li>
<li><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_page[{$MODE}]={$METADATA.paginator.current_page+1}" rel="&x{$BASEID}_page[{$MODE}]={$METADATA.paginator.current_page+1}">next</a></li>
</ul>