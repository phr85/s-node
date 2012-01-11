{literal}
<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
window.parent.frames['slave2'].document.forms[0].submit();
//-->
</script>
{/literal}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="edit">
 {include file="includes/buttons.tpl" data=$EDIT_ARTICLE_BUTTONS}
 {include file="includes/lang_selector_submit.tpl" form="edit" action="saveArticle"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="left">{"Question (Display)"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_title" value="{$ARTICLE.title}" size="42"></td>
  </tr>
  <tr>
   <td class="left">{"Question detail"|translate}</td>
   <td class="right"><textarea name="x{$BASEID}_question_detail" cols="70" rows="6">{$ARTICLE.question_detail}</textarea></td>
  </tr>
  <tr>
   <td class="left">{"Answer"|translate}</td>
   <td class="right"><textarea name="x{$BASEID}_answer" cols="70" rows="6">{$ARTICLE.answer}</textarea></td>
  </tr>
 </table>
 <input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}">
 <input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}">
 <input type="hidden" name="x{$BASEID}_node_pid">
 <input type="hidden" name="x{$BASEID}_node_id">
 <input type="hidden" name="x{$BASEID}_position">
 <input type="hidden" name="x{$BASEID}_article_id">
</form>



