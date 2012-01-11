{subplugin package="ch.iframe.snode.forum" module="search"}
<div class="forum">
{if sizeof($CATEGORIES) > 0}
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td colspan="2" class="header"><b>{"Categories"|translate}</b><br />{"The following categories are in this area"|translate}:</td>
</tr>
</table>
<div class="categorylist_container">
<table cellpadding="0" cellspacing="0" width="100%" class="categorylist">
<tr>
 <td class="list_header">{"Category"|translate}</td>
 <td class="list_header_info" width="50">{"Forums"|translate}</td>
 <td class="list_header_info" width="50">{"Topics"|translate}</td>
 <td class="list_header_info" width="50">{"Postings"|translate}</td>
</tr>
{foreach from=$CATEGORIES item=CATEGORY}
<tr>
 <td class="entry"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_category_id={$CATEGORY.id}">{$CATEGORY.title}</a><br /><span class="category_desc">{$CATEGORY.description}</span></td>
 <td class="entry_info">{$CATEGORY.forum_count}</td>
 <td class="entry_info">{$CATEGORY.topic_count}</td>
 <td class="entry_info">{$CATEGORY.posting_count}</td>
</tr>
{/foreach}
</table>
</div>
<br />
{/if}
{if sizeof($FORUMS) > 0}
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td colspan="2" class="header"><b>{"Forums in category"|translate} "{$PARENT_CATEGORY.title}"</b><br />{"The following forums are in this area"|translate}:</td>
</tr>
<tr>
 <td colspan="2" class="header"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}">{"Back to overview"|translate}</a></td>
</tr>
</table>
<div class="forumlist_container">
<table cellpadding="0" cellspacing="0" width="100%" class="categorylist">
<tr>
 <td class="list_header">{"Forum"|translate}</td>
 <td class="list_header_info" width="50">{"Topics"|translate}</td>
 <td class="list_header_info" width="50">{"Postings"|translate}</td>
 <td class="list_header_info" width="190" style="text-align: left;">{"Last entry"|translate}</td>
</tr>
{foreach from=$FORUMS item=FORUM}
<tr>
 <td class="entry"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_forum_id={$FORUM.id}">{$FORUM.title}</a><br /><span class="category_desc">{$FORUM.description}</span></td>
 <td class="entry_info">{$FORUM.topic_count}</td>
 <td class="entry_info">{$FORUM.posting_count}</td>
 <td class="entry_info_small"><a href="#">{$FORUM.lastentry_posting_title}</a><br />({$FORUM.firstName} {$FORUM.lastName} {$FORUM.lastentry_date|date_format:"%d.%m.%Y, %H:%I"})</td>
</tr>
{/foreach}
</table>
{/if}
</div>
<div style="float: left; width: 49%; margin-right: 13px;">
{subplugin package="ch.iframe.snode.forum" module="top_topics"}
</div>
<div style="float: right; width: 49%;">
{subplugin package="ch.iframe.snode.forum" module="newest_topics"}
</div>