{$ERRORMSG}
<h1 class="forum">{$FORUM.title}</h1>
<h2 class="forum">{$FORUM.description}</h2>
<a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.categories.TPL}">{"Back to the categories overview"|translate}</a>
{if "write"|allowed}
| <a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.topic.new.TPL}&amp;x{$BASEID}_forum_id={$FORUM.id}">{"Create a new topic"|translate}</a>
 | <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_forum_id={$FORUM.id}&amp;x{$BASEID}_action=addforumnotifier">{"Notifiy me about all postings"|translate}</a>
{/if}
<br /><br />
<table cellpadding="0" cellspacing="1" width="100%" id="forum">
 {if sizeof($TOPICS) > 0}
 <tr>
  <td class="header" colspan="2"><b>{"Topics"|translate}</b></td>
  <td class="header" width="80" align="center">{"Replies"|translate}</td>
  <td class="header" width="80" align="center">{"Views"|translate}</td>
  <td class="header" style="width: 200px;">{"Latest posting"|translate}</td>
 </tr>
 {foreach from=$TOPICS item=TOPIC}
 <tr>
  <td class="topic_icon"><img src="{$XT_IMAGES}icons/document.png" alt=""/></td>
  <td class="topic_dark"><span class="topic_title"><a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.topic.TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_forum_id={$FORUM.id}">{$TOPIC.title}</a></span>  {"by"|translate} {$TOPIC.username}</td>
  <td class="topic_light" align="center">{$TOPIC.posting_count}&nbsp;</td>
  <td class="topic_dark" align="center">{$TOPIC.view_count}&nbsp;</td>
  <td class="topic_light"><a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.topic.TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_forum_id={$FORUM.id}&amp;x{$BASEID}_page=last#latest">{$TOPIC.lastentry_date|date_format:"%d.%m.%Y %H:%I"}  {"by"|translate} {$TOPIC.lastentry}&nbsp;</a></td>
 </tr>
 {/foreach}
 {else}
 <tr>
  <td class="topic_light" style="color: black;" colspan="6">{"There are currently no topics in this forum"|translate}</td>
 </tr>
 {/if}
</table>
<br />

{include file="ch.iframe.snode.forum/includes/navigator.tpl"}