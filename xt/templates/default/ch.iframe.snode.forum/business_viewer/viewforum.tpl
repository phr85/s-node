<div class="forum">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td colspan="2" class="header"><b>Forum "{$FORUM.title}"</b><br />{"The following topics are in this forum"|translate}:</td>
</tr>
<tr>
 <td colspan="2" class="header"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_forum_id={$FORUM.id}&amp;x{$BASEID}_action=newTopic">{"Create a new topic"|translate}</a> |
&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_category_id={$FORUM.category_id}">{"Back to the forums overview"|translate}</a> | 
&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}">{"Back to the categories overview"|translate}</a></td>
</tr>
</table>
<div class="topiclist_container">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td class="list_header">{"Description of the forum"|translate}</td>
</tr>
<tr>
 <td class="entry" style="font-weight: normal;">{$FORUM.description}</td>
</tr>
</table>
</div>
<br />
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td colspan="2" class="header"><b>{"Topics in forum"|translate} "{$FORUM.title}"</b><br />{"The following topics are in this forum"|translate}:</td>
</tr>
<tr>
 <td colspan="2" class="header"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_forum_id={$FORUM.id}&amp;x{$BASEID}_action=newTopic">{"Create a new topic"|translate}</a></td>
</tr>
</table>
<div class="topiclist_container">
<table cellpadding="0" cellspacing="0" width="100%">
 {if sizeof($TOPICS) > 0}
 <tr>
  <td class="list_header" width="80">{"Author"|translate}</td>
  <td class="list_header">{"Topic"|translate}</td>
  <td class="list_header_info" width="40">{"Replies"|translate}</td>
  <td class="list_header_info" width="40">{"Views"|translate}</td>
  <td class="list_header_info" width="120" style="text-align: left;">{"Latest posting"|translate}</td>
 </tr>
 {foreach from=$TOPICS item=TOPIC}
 <tr>
  <td class="entry" style="font-weight: normal;"><b>{$TOPIC.author_firstName} {$TOPIC.author_lastName}</b><br />{$TOPIC.author}</td>
  <td class="entry"><span class="topic_title"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}">{$TOPIC.title}</a></span> <span style="font-weight: normal;">({$TOPIC.creation_date|date_format:"%d.%m.%Y, %H:%I"})</span></td>
  <td class="entry_info">{$TOPIC.posting_count}&nbsp;</td>
  <td class="entry_info">{$TOPIC.view_count}&nbsp;</td>
  <td class="entry_info_small"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page=last#latest">{$TOPIC.lastentry_date|date_format:"%d.%m.%Y, %H:%I"}<br />{$TOPIC.firstName} {$TOPIC.lastName}</a></td>
 </tr>
 {/foreach}
 {else}
 <tr>
  <td style="color: black;" colspan="6">{"There are currently no topics in this forum"|translate}</td>
 </tr>
 {/if}
</table>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td colspan="2" class="header"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_forum_id={$FORUM.id}&amp;x{$BASEID}_action=newTopic">{"Create a new topic"|translate}</a> |
&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_category_id={$FORUM.category_id}">{"Back to the forums overview"|translate}</a> | 
&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}">{"Back to the categories overview"|translate}</a></td>
</tr>
</table>