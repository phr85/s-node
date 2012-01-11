<h1 class="forum" style="color:red;">{"report entry"|translate}: {$POSTING.title}</h1>
&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.topic.TPL}">{"Back to the topic"|translate}</a><br />
<br />
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
 <tr class="{cycle values=posting_light,posting_light,posting_light,posting_dark,posting_dark,posting_dark}">
  <td class="posting" valign="top"><span class="posting_author">{$POSTING.username}</span></td>
  <td class="posting_body" valign="top">
   <form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="reply">
   <table cellpadding="0" cellspacing="0">
    <tr>
     <td>
     {"Your remark"|translate}<br />
      <textarea name="x{$BASEID}_message" style="width: 500px; height: 80px;"></textarea><br />
      <input type="submit" class="img_button" value="{'Create reply'|translate}" />
      <input type="hidden" name="x{$BASEID}_alert_id" value="{$POSTING.id}" />
      <input type="hidden" name="x{$BASEID}_action" value="report" />
      <input type="hidden" name="x{$BASEID}_topic_id" value="{$POSTING.topic_id}" />
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
<br />
&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.topic.TPL}&amp;x{$BASEID}_topic_id={$POSTING.topic_id}">{"Back to the topic"|translate}</a><br />