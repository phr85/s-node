<div class="forum">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td colspan="2" class="header"><b>{"Top"|translate} {$COUNT} {"topics"|translate}</b><br />{"The following topics are most viewed"|translate}:</td>
</tr>
</table>
<div class="topiclist_container">
<table cellpadding="0" cellspacing="0" width="100%" class="categorylist">
<tr>
 <td class="list_header">{"Topic"|translate}</td>
 <td class="list_header_info" width="50">{"Views"|translate}</td>
</tr>
{foreach from=$TOPICS item=TOPIC}
<tr>
 <td class="entry"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}">{$TOPIC.title}</a></td>
 <td class="entry_info">{$TOPIC.view_count}</td>
</tr>
{/foreach}
</table>
</div>
</div>