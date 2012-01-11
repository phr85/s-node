{$ERRORMSG}
<h1 class="forum">{$TPL_REAL_TITLE}</h1>
<h2 class="forum">{"Description"|translate}</h2>
<table cellpadding="0" cellspacing="1" width="100%" id="forum">
<tr>
 <td class="header" colspan="2"><b>{"Forum"|translate}</b></td>
 <td class="header" width="80" align="center">{"Topics"|translate}</td>
 <td class="header" width="80" align="center">{"Replies"|translate}</td>
 <td class="header" style="width: 200px;">{"Latest posting"|translate}</td>
</tr>
{foreach from=$CATEGORIES item=CATEGORY}
<tr>
 <td colspan="5" class="category">{$CATEGORY.title}</td>
</tr>
{foreach from=$FORUMS[$CATEGORY.id] item=FORUM}
<tr>
 <td class="forum_icon">&nbsp;</td>
 <td class="forum_dark"><span class="forum_title"><a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.forum.TPL}&amp;x{$BASEID}_forum_id={$FORUM.id}">{$FORUM.title}</a></span><br />{$FORUM.description}</td>
 <td class="forum_light">{$FORUM.topic_count}</td>
 <td class="forum_dark" align="center">{$FORUM.posting_count}</td>
 <td class="forum_light"><a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.topic.TPL}&amp;x{$BASEID}_topic_id={$FORUM.lastentry_topic}&amp;x{$BASEID}_page=last#latest">{$FORUM.lastentry_date|date_format:"%d.%m.%Y %H:%I"}  {"by"|translate} {$FORUM.username}&nbsp;</a></td>
</tr>
{/foreach}
{/foreach}
</table>
<form action="index.php" method="post" name="default">
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_category_id" value="" />
<input type="hidden" name="x{$BASEID}_forum_id" value="" />

</form>