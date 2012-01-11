<h1 class="forum">{"Reply to"|translate}: {$POSTING.title}</h1>
&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.topic.TPL}">{"Back to the topic"|translate}</a><br />
<br />
<form method="post" enctype="multipart/form-data" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="reply">

<table cellpadding="0" cellspacing="1" width="100%" id="forum">
 <tr>
  <td class="header" width="160">{"Author"|translate}
  </td>
  <td class="header">{"Message"|translate}</td>
 </tr>
 <tr class="{cycle values=posting_light,posting_light,posting_light,posting_dark,posting_dark,posting_dark}">
  <td rowspan="2" class="posting" valign="top"><span class="posting_author">{$POSTING.username}</span></td>
  <td class="posting_info" valign="top">{"Created at"|translate}: {$POSTING.creation_date}</td>
 </tr>
 <tr class="{cycle values=posting_light,posting_light,posting_light,posting_dark,posting_dark,posting_dark}">
  <td class="posting_body" valign="top">{$POSTING.body}</td>
 </tr>
 <tr>
  <td class="posting_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" width="1" /></td>
 </tr>

 {if $PREVIEW}
 <tr class="{cycle values=posting_light,posting_light,posting_light,posting_dark,posting_dark,posting_dark}">
 <td class="posting"><b>{"preview"|translate}</b></td>
 <td class="posting_body" valign="top">{$PREVIEW}</td>
 </tr>
 <tr>
  <td class="posting_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" width="1" /></td>
 </tr>
 {/if}
 
 
 <tr class="{cycle values=posting_light,posting_light,posting_light,posting_dark,posting_dark,posting_dark}">
  <td class="posting" valign="top"><span class="posting_author">{$POSTING.username}</span>
<br />  
  
     <input type="checkbox" name="x{$BASEID}_mail" {if $mail=="on"}checked="checked"{/if} />{"Notification"|translate}<br />
     
     
  </td>
  <td class="posting_body" valign="top">
   
   <table cellpadding="0" cellspacing="0">
    <tr>
     <td width="80" valign="top">{"Title"|translate}:</td>
     <td>
     {get_value param="title" assign="replytitle"}
     <input type="text" name="x{$BASEID}_title" size="42" value="{if $replytitle!=""}{$replytitle}{else}{"Re"|translate}: {$POSTING.title}{/if}" onfocus="this.select()"/>
     </td>
    </tr>
     <td valign="top">{"Text"|translate}:</td>
     <td>
      <textarea name="x{$BASEID}_body" style="width: 500px; height: 200px;">{$BODY}</textarea><br />
      {if $FILENAME}
      Filename: <b>{$FILENAME.name}</b> - Filesize: <b>{$FILENAME.size|format_filesize}</b>
      
      {else}
         <input type="file" size="36" name="file">
       {/if}
       <br />
       
      {actionIcon
      icon="view.png"
      action="preview"
      form="reply"
      title="preview"
      label=" preview"
      }  
      &nbsp;
      {actionIcon
      icon="save.png"
      action="reply"
      form="reply"
      title="reply"
      label=" reply"
      } 
      
       
      <input type="hidden" name="x{$BASEID}_topic_id" value="{$POSTING.topic_id}" />
      <input type="hidden" name="x{$BASEID}_reply_to" value="{$POSTING.id}" />
      <input type="hidden" name="x{$BASEID}_forum_id" value="{$TOPIC.forum_id}" />
      <input type="hidden" name="x{$BASEID}_action" value="" />
     </td>
    </tr>
   </table>
   
  </td>
 </tr>
 <tr>
  <td class="posting_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" width="1" /></td>
 </tr>
</table>
</form>
<br />