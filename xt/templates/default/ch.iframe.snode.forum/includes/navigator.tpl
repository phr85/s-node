<ul class="forum_pages">
<li class="info">{"Total Postings"|translate}: <b>{$PAGES.entries}</b></li>
<li class="info">{"Actual Page"|translate}: <b>{$PAGES.actual}</b></li>
<li class="info">{"Total Pages"|translate}: <b>{$PAGES.amount}</b></li>
<li class="title">{"Pages"|translate}</li>
<li><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page={$PAGES.first}">&laquo; {"First"|translate}</a></li>
<li><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page={$PAGES.prev}">&lt; {"Back"|translate}</a></li>
<li><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page={$PAGES.next}">{"Forward"|translate} &gt;</a></li>
<li><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page={$PAGES.last}">{"Last"|translate} &raquo;</a></li>
</ul><br /><br />