<div class="forum">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td class="header"><b>{"Forum"|translate} "<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_forum_id={$FORUM.id}">{$FORUM.title}</a>" &gt; {"Topic"|translate} "{$TOPIC.title}"</b><br />{"The newest topics in this forums"|translate}:</td>
</tr>
<tr>
 <td class="header"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_reply_to={$POSTINGS.0.id}">{"Create a new reply"|translate}</a> |
&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_forum_id={$TOPIC.forum_id}">{"Back to the topics overview"|translate}</a></td>
</tr>
</table>

{if sizeof($PAGES) > 1}
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td class="header">
{"Total Postings"|translate}: <b>{$POSTINGS_COUNT}</b> - {"Pages"|translate}
{if sizeof($PAGES) > 2 && $ACTIVE_PAGE > 1}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page=1">&laquo; {"First"|translate}</a>{/if}
{if sizeof($PAGES) > 1 && $ACTIVE_PAGE > 1} - <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page={$ACTIVE_PAGE-1}">&lt; {"Back"|translate}</a>{/if} -
{foreach from=$PAGES key=PAGE item=P}
{if $ACTIVE_PAGE == $PAGE}&nbsp;<span style="color: black;"><b>{$PAGE}</b></span>&nbsp;{else}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page={$PAGE}">{$PAGE}</a>{/if}
{/foreach}
{if $ACTIVE_PAGE < sizeof($PAGES)} - <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page={$ACTIVE_PAGE+1}">{"Forward"|translate} &gt;</a>{/if}
{if $ACTIVE_PAGE < sizeof($PAGES) && sizeof($PAGES) > 2}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page=last">{"Last"|translate} &raquo;</a>{/if}
</td>
</tr>
</table>
{/if}

<div class="topiclist_container">
<table cellpadding="0" cellspacing="0" width="100%" id="forum">
 {if sizeof($POSTINGS) > 0}
 <tr>
  <td class="list_header" width="110">{"Author"|translate}</td>
  <td colspan="3" class="list_header">{"Message"|translate}</td>
 </tr>
 {foreach from=$POSTINGS item=POSTING}
 <tr class="{cycle values=posting_light,posting_light,posting_light,posting_dark,posting_dark,posting_dark}">
  <td rowspan="2" class="posting" valign="top"><span class="posting_author">{$POSTING.username}</span><br />{"Registered at"|translate}:<br />{$POSTING.user_date|date_format:"%d.%m.%Y"}</td>
  <td class="posting_info" valign="top">{if $POSTING.title != ''}{"Title"|translate}: <b>{$POSTING.title}</b> - {/if}{"Created at"|translate}: {$POSTING.creation_date|date_format:"%d.%m.%Y %H:%I"} - <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$POSTING.topic_id}&amp;x{$BASEID}_reply_to={if $NESTED}{$POSTING.id}{else}{$POSTINGS.0.id}{/if}">{"Reply"|translate}</a>&nbsp;</td>
 </tr>
 <tr class="{cycle values=posting_light,posting_light,posting_light,posting_dark,posting_dark,posting_dark}" {if $LAST && $LASTNODE == $POSTING.id}style="background-color: orange;"{/if}>
  <td class="posting_body" valign="top">{if $LASTNODE == $POSTING.id}<a name="latest"></a>{/if}{$POSTING.body}</td>
 </tr>
 <tr class="{cycle values=posting_light,posting_light,posting_light,posting_dark,posting_dark,posting_dark}">
  <td class="posting" valign="top"><a href="#top"><img src="/images/icons/forum/arrow_up.gif" alt="{"To the top"|translate}" title="{"To the top"|translate}"/></a></td>
  <td class="posting" valign="top">&nbsp;</td>
 </tr>
 <tr>
  <td class="posting_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" width="1" /></td>
 </tr>
 {foreach from=$SUB_POSTINGS[$POSTING.id] item=SUBPOSTING name=sp}
 <tr class="posting_light">
  <td class="posting">&nbsp;</td>
  <td class="posting" style="border-left: {$SUBPOSTING.level*15-40}px solid #E7EEF0;"><img id="switcher{$SUBPOSTING.id}" src="{$XT_IMAGES}icons/{if !$ALL_NODES_OPEN}{if $LAST && $LASTNODE == $SUBPOSTING.id}minus{else}plus{/if}{else}minus{/if}.gif" alt="" style="cursor: hand; cursor: pointer; margin-right: 5px;" onclick="switchSubPosting(this,{$SUBPOSTING.id});" /> {if $SUBPOSTING.title != ''}<a href="#" onclick="switchSubPosting(document.getElementById('switcher{$SUBPOSTING.id}'),{$SUBPOSTING.id});"><b>{$SUBPOSTING.title}</b></a>{/if} {"by"|translate} {$SUBPOSTING.username} {"at"|translate} {$SUBPOSTING.creation_date|date_format:"%d.%m.%Y %H:%I"} - <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$POSTING.topic_id}&amp;x{$BASEID}_reply_to={if $NESTED}{$SUBPOSTING.id}{else}{$POSTINGS.0.id}{/if}">{"Reply"|translate}</a>
   {if $LASTNODE == $SUBPOSTING.id}<a name="latest"></a>{/if}
   <div id="subposting{$SUBPOSTING.id}" class="subposting" style="{if !$ALL_NODES_OPEN}{if $LAST && $LASTNODE == $SUBPOSTING.id}background-color: orange; display: block;{else}display: none;{/if}{/if}">
   {$SUBPOSTING.body}
   </div>
  </td>
 </tr>
 {if $LAST_ENTRIES[$SUBPOSTING.pid] == $SUBPOSTING.id && $SUBPOSTING.subs < 1}
 <tr>
  <td class="posting_separator" colspan="4" {if $SUBPOSTING.level > 3}style="background-color: #B6C2D2;"{/if}><img src="{$XT_IMAGES}spacer.gif" width="1" /></td>
 </tr>
 {/if}
 {/foreach}
 {/foreach}
 {else}
 <tr>
  <td class="topic_light" style="color: black;" colspan="6">{"There are currently no replies in this topic"|translate}</td>
 </tr>
 {/if}
</table>
</div>

{if sizeof($PAGES) > 1}
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td class="header">
{"Total Postings"|translate}: <b>{$POSTINGS_COUNT}</b> - {"Pages"|translate}
{if sizeof($PAGES) > 2 && $ACTIVE_PAGE > 1}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page=1">&laquo; {"First"|translate}</a>{/if}
{if sizeof($PAGES) > 1 && $ACTIVE_PAGE > 1} - <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page={$ACTIVE_PAGE-1}">&lt; {"Back"|translate}</a>{/if} -
{foreach from=$PAGES key=PAGE item=P}
{if $ACTIVE_PAGE == $PAGE}&nbsp;<span style="color: black;"><b>{$PAGE}</b></span>&nbsp;{else}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page={$PAGE}">{$PAGE}</a>{/if}
{/foreach}
{if $ACTIVE_PAGE < sizeof($PAGES)} - <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page={$ACTIVE_PAGE+1}">{"Forward"|translate} &gt;</a>{/if}
{if $ACTIVE_PAGE < sizeof($PAGES) && sizeof($PAGES) > 2}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_page=last">{"Last"|translate} &raquo;</a>{/if}
</td>
</tr>
</table>
{/if}

<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td class="header"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_reply_to={$POSTINGS.0.id}">{"Create a new reply"|translate}</a> |
&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_forum_id={$TOPIC.forum_id}">{"Back to the topics overview"|translate}</a></td>
</tr>
</table>
</div>
{literal}
<script type="text/javascript"><!--
function switchSubPosting(elem,id){
    if(document.getElementById('subposting' + id).style.display == 'none'){
        document.getElementById('subposting' + id).style.display='block';
        elem.src='{/literal}{$XT_IMAGES}{literal}icons/minus.gif';
    } else {
        document.getElementById('subposting' + id).style.display='none';
        elem.src='{/literal}{$XT_IMAGES}{literal}icons/plus.gif';
    }
}
//--></script>
{/literal}