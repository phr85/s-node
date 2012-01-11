<div class="forum">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td colspan="2" class="header"><b>{"Newest"|translate} {$COUNT} {"topics"|translate}</b><br />{"The newest topics in this forums"|translate}:</td>
</tr>
</table>
<div class="topiclist_container">
<table cellpadding="0" cellspacing="0" width="100%" class="categorylist">
<tr>
 <td class="list_header">{"Topic"|translate}</td>
 <td class="list_header_info" width="100">{"Creation date"|translate}</td>
</tr>
{foreach from=$TOPICS item=TOPIC}
<tr>
 <td class="entry"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}">{$TOPIC.title}</a></td>
 <td class="entry_info">{$TOPIC.creation_date|date_format:"%d.%m.%Y %H:%I"}</td>
</tr>
{/foreach}
</table>
</div>
</div>