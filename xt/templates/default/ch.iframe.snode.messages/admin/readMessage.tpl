<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form method="POST" name="readmessage">
 {include file="includes/buttons.tpl" data=$VIEW_BUTTONS form="readmessage"}
 <table cellpadding="0" cellspacing="0" width="100%">
  <tr>
  <td class="view_header" colspan="2">
   <span class="title">{$MAIL.subject}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
  <tr>
   <td class="view_left">{"From"|translate}</td>
   <td class="view_right">{$MAIL.username}</td>
  </tr>
  <tr>
   <td class="view_left">{"Priority"|translate}</td>
   <td class="view_right">{if $MAIL.priority == 2}<img src="{$XT_IMAGES}icons/pin_red.png" alt="" />{else}{if $MAIL.priority == 0}<img src="{$XT_IMAGES}icons/pin_green.png" alt="" />{else}Normal{/if}{/if}</td>
  </tr>
  <tr>
   <td class="view_left">{"Received at"|translate}</td>
   <td class="view_right">{$MAIL.send_date|date_format:"%d.%m.%Y %H:%M:%S"}</td>
  </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
  <tr>
   <td class="view_right" colspan="2" style="height: 200px; padding: 15px; vertical-align: top;">{$MAIL.text|nl2br}&nbsp;</td>
  </tr>
 </table>
 <input type="hidden" name="x{$BASEID}_message_flow" value="{if $MAIL.message_flow == 0}{$MAIL.id}{else}{$MAIL.message_flow}{/if}">
 <input type="hidden" name="x{$BASEID}_id" value="{$MAIL.id}">
 <input type="hidden" name="x{$BASEID}_receiver" value="{$MAIL.username}">
 <input type="hidden" name="x{$BASEID}_subject" value="{$MAIL.subject}">
 <input type="hidden" name="x{$BASEID}_text" value="{$MAIL.text}">
</form>