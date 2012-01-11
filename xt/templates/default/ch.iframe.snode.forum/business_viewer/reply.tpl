<div class="forum">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td class="header"><b>{"Reply to"|translate} "{$POSTING.title}"</b><br />{"Create a new answer"|translate}:</td>
</tr>
<tr>
 <td class="header">&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$POSTING.topic_id}">{"Back to the topic"|translate}</a></td>
</tr>
</table>
<div class="categorylist_container">
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="list_header" width="110">{"Author"|translate}</td>
  <td class="list_header">{"Message"|translate}</td>
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
 <tr class="{cycle values=posting_light,posting_light,posting_light,posting_dark,posting_dark,posting_dark}">
  <td class="posting" valign="top"><span class="posting_author">{$POSTING.username}</span></td>
  <td class="posting_body" valign="top">
   <form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="reply">
   <table cellpadding="0" cellspacing="0">
    <tr>
     <td width="80" valign="top">{"Title"|translate}:</td>
     <td><input type="text" name="x{$BASEID}_title" size="42" /></td>
    </tr>
     <td valign="top">{"Text"|translate}:</td>
     <td>
      <textarea name="x{$BASEID}_body" style="width: 400px; height: 200px;"></textarea><br />
      <input type="submit" class="img_button" value="{'Create reply'|translate}" />
      <input type="hidden" name="x{$BASEID}_topic_id" value="{$POSTING.topic_id}">
      <input type="hidden" name="x{$BASEID}_reply_to" value="{$POSTING.id}">
      <input type="hidden" name="x{$BASEID}_forum_id" value="{$TOPIC.forum_id}">
      <input type="hidden" name="x{$BASEID}_action" value="reply">
     </td>
    </tr>
   </table>
   </form>
  </td>
 </tr>
 <tr>
  <td class="posting_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" width="1" /></td>
 </tr>
</table>
</div>
</div>
<br />
&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_topic_id={$POSTING.topic_id}">{"Back to the topic"|translate}</a><br />