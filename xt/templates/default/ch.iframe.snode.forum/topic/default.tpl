{$ERRORMSG}
<h1 class="forum">{$TOPIC.title}</h1> 
{include file="ch.iframe.snode.forum/includes/navigator.tpl"}

<table cellpadding="0" cellspacing="1" width="100%" id="forum">
 {if sizeof($POSTINGS) > 0}
 <tr>
  <td class="header" width="160">{"Author"|translate}</td>
  <td colspan="3" class="header">{"Message"|translate}</td>
 </tr>
 {foreach from=$POSTINGS item=POSTING name="postings"}
 {cycle values="posting_light,posting_dark" assign="trclass"}

 <tr class="{$trclass}">
  <td rowspan="2" class="posting" valign="top"><span class="posting_author">
  {$POSTING.username}</span><br />{"Registered at"|translate}:<br />{$POSTING.user_date|date_format:"%d.%m.%Y"}</td>
  <td class="posting_info" valign="top">{if $POSTING.title != ''}{"Title"|translate}: <b>{$POSTING.title}</b> - {/if}{"Created at"|translate}: {$POSTING.creation_date|date_format:"%d.%m.%Y %H:%M"} | #{$POSTING.id}</td>
 </tr>
 <tr class="{$trclass}" {if $LAST && $LASTNODE == $POSTING.id}style="background-color: orange;"{/if}>
  <td class="posting_body{if $POSTING.l==1}_topic{/if}" valign="top">{if $LASTNODE == $POSTING.id}<a name="latest"></a>{/if}{$POSTING.body}
  {if "write"|allowed}  
  {if $POSTING.upload_file_id!=0}
  {if $POSTING.filetype==1}<img src="/download.php?file_id={$POSTING.upload_file_id}&amp;file_version=cube" alt="" />{/if}
  <a href="download.php?file_id={$POSTING.upload_file_id}&amp;download=true"><b>{$POSTING.filename}</b> {$POSTING.filesize|format_filesize}</a><br />{/if}
  {/if}
  </td>
 </tr>
 <tr class="{$trclass}">
  <td class="posting" valign="top">
  {if "write"|allowed}<a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.topic.alert.TPL}&amp;x{$BASEID}_alert_id={$POSTING.id}"><img  src="/images/icons/hand_red_card.png" {"report entry"|alttag} /></a>{/if}
  {if $smarty.foreach.postings.first}
  {actionIcon ask="delete complete thread" action="deleteThread" perm="moderate" icon="delete2.png" thread_id=$POSTING.id form="topic" topic_id=$POSTING.topic_id delete_thread="true" title="delete complete posting"}
  {else}
  {actionIcon action="deleteThread" perm="moderate" icon="delete.png" thread_id=$POSTING.id form="topic" topic_id=$POSTING.topic_id title="delete"}
  {/if}
  {if $POSTING.active}
  {actionIcon action="disableThread" perm="moderate" icon="active.png" thread_id=$POSTING.id form="topic" topic_id=$POSTING.topic_id title="deactivate" is_topic="true"}  
  {else}
  {actionIcon action="enableThread" perm="moderate" icon="inactive.png" thread_id=$POSTING.id form="topic" topic_id=$POSTING.topic_id title="activate" is_topic="true"}  
  {/if}
  
  </td>
  <td class="posting" valign="top">{if "write"|allowed}
  <a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.topic.reply.TPL}&amp;x{$BASEID}_topic_id={$POSTING.topic_id}&amp;x{$BASEID}_reply_to={$POSTING.id}"><img src="/images/icons/document_new.png" {"Reply"|alttag} /> {"Reply"|translate}</a>
  {/if}
  &nbsp;</td>
 </tr>
 {foreach from=$SUB_POSTINGS[$POSTING.id] item=SUBPOSTING name=sp}
 <tr class="{$trclass}_sub">
  <td class="posting">{actionIcon action="deleteThread" perm="moderate" icon="delete.png" thread_id=$SUBPOSTING.id form="topic" topic_id=$POSTING.topic_id title="delete"}
  {if $SUBPOSTING.active}
  {actionIcon action="disableThread" perm="moderate" icon="active.png" thread_id=$SUBPOSTING.id form="topic" topic_id=$POSTING.topic_id title="deactivate"}  
  {else}
  {actionIcon action="enableThread" perm="moderate" icon="inactive.png" thread_id=$SUBPOSTING.id form="topic" topic_id=$POSTING.topic_id title="activate"}  
  {/if} 
  <b>{$SUBPOSTING.username} </b><br />
  {$SUBPOSTING.creation_date|date_format:"%d.%m.%Y %H:%M"} <br />
  <sub>#{$SUBPOSTING.id}</sub> 
  &nbsp;
  <br />
  {if "write"|allowed}<a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.topic.alert.TPL}&amp;x{$BASEID}_alert_id={$SUBPOSTING.id}"><img src="/images/icons/document_red.png" {"report entry"|alttag} /></a>{/if}
  
  </td>
  <td class="posting" style="border-left: {$SUBPOSTING.level*15-40}px solid #D9E2ED;">
   {$SUBPOSTING.title} <br />
         <div id="subposting{$SUBPOSTING.id}" style="color: black; background-color: #CCD8E8; padding: 10px; margin: 10px; {if !$ALL_NODES_OPEN}{if $LAST && $LASTNODE == $SUBPOSTING.id}background-color: orange; display: block;{else}display: none;{/if}{/if}">{$SUBPOSTING.body}</div>
  {if "write"|allowed}
  {if $SUBPOSTING.upload_file_id!=0}
  {if $SUBPOSTING.filetype==1}<img src="/download.php?file_id={$SUBPOSTING.upload_file_id}&amp;file_version=cube" alt="" />{/if}
  <a href="download.php?file_id={$SUBPOSTING.upload_file_id}&amp;download=true"><b>{$SUBPOSTING.filename}</b> {$SUBPOSTING.filesize|format_filesize}</a><br />{/if}
  <a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.topic.reply.TPL}&amp;x{$BASEID}_topic_id={$POSTING.topic_id}&amp;x{$BASEID}_reply_to={$SUBPOSTING.id}"><img src="/images/icons/document_new.png" {"Reply"|alttag} /> {"Reply"|translate}</a>
  {/if}
  </td>
 </tr>
 {/foreach}

 {/foreach}
 {else}
 
 <tr>
  <td class="topic_light" style="color: black;" colspan="6">{"There are currently no replies in this topic"|translate}</td>
 </tr>
 {/if}
</table>
<br /><a name="latest"></a>
{include file="ch.iframe.snode.forum/includes/navigator.tpl"}
{if "write"|allowed}<a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.topic.reply.TPL}&amp;x{$BASEID}_topic_id={$TOPIC.id}&amp;x{$BASEID}_reply_to={$POSTINGS.0.id}">{"Create a new reply"|translate}</a> | {/if}
<a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.forum.TPL}">{"Back to the topics overview"|translate}</a><br /><br />

{literal}
<script type="text/javascript"><!--
function switchSubPosting(elem,id){
    if(document.getElementById('subposting' + id).style.display == 'none'){
        document.getElementById('subposting' + id).style.display='block';
        elem.src='{$XT_IMAGES}icons/minus.gif';
    } else {
        document.getElementById('subposting' + id).style.display='none';
        elem.src='{$XT_IMAGES}icons/plus.gif';
    }
}
//-->
</script>
{/literal}
<form name="topic" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post">
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_thread_id" value="" />
<input type="hidden" name="x{$BASEID}_is_topic" value="" />
<input type="hidden" name="x{$BASEID}_topic_id" value="" />
<input type="hidden" name="x{$BASEID}_delete_thread" value="" />

</form>