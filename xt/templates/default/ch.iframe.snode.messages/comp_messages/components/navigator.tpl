<ul class="XTMSGnavigator">
<li {if $xt50_comp_messages.mode == "inbox_new"} class="selected"{/if}><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_mode=inbox_new" rel="inbox_new">{"inbox_new"|translate}</a></li>
<li {if $xt50_comp_messages.mode == "inbox"} class="selected"{/if}><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_mode=inbox"  rel="inbox">{"inbox"|translate}</a></li>
<li {if $xt50_comp_messages.mode == "outbox" }class="selected"{/if}><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_mode=outbox"  rel="outbox">{"outbox"|translate}</a></li>
<li {if $xt50_comp_messages.mode == "wastebasket"} class="selected"{/if}><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_mode=wastebasket" rel="wastebasket">{"wastebasket"|translate}</a></li>
</ul>