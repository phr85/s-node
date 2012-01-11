{literal}
<script language="JavaScript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form method="post">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Script"|translate}:</span><span class="title"> {$SCRIPT.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" value="{$SCRIPT.title|htmlspecialchars}" size="42"></td>
 </tr>
 <tr>
  <td colspan="2" class="right">{$SCRIPT.content_highlighted}</td>
 </tr>
 <tr>
  <td colspan="2" class="right">
   <textarea name="x{$BASEID}_content" cols="70" rows="40" style="width: 100%; font-family: Courier New;">{$SCRIPT.content}</textarea>
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_form_id" />
<input type="hidden" name="x{$BASEID}_script_id" />
</form>
