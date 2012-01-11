<h1 class="forum">{"Create new topic in"|translate}: {$FORUM.title}</h1>
<h2 class="forum">{"Pages"|translate}</h2>
&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$SETTINGS.forum.TPL}&amp;x{$BASEID}_forum_id={$FORUM.id}">{"Back to the topics overview"|translate}</a><br />
<br />
<table cellpadding="0" cellspacing="1" width="100%" id="forum">
 <tr>
  <td class="header" width="160">{"Author"|translate}</td>
  <td class="header">{"Message"|translate}</td>
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
      <textarea name="x{$BASEID}_body" style="width: 650px; height: 200px;"></textarea><br />
      <input type="submit" class="img_button" value="{'Create topic'|translate}" />
      <input type="hidden" name="x{$BASEID}_forum_id" value="{$FORUM.id}">
      <input type="hidden" name="x{$BASEID}_action" value="createTopic">
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
&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_forum_id={$FORUM.id}">{"Back to the topics overview"|translate}</a><br />