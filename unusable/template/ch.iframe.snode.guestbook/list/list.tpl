<form method="POST" name="guestbook_list">
 <input type="hidden" name="TPL" value="{$TPL}">
 <input type="hidden" name="x{$BASEID}_mod" value="list">
 {foreach from=$BUTTONS item=BUTTON}
    <input type="submit" value="{$BUTTON.label}" name="submit_{$BUTTON.action}" class="{$BUTTON.class}" onclick="document.forms['guestbook_list'].x{$BASEID}_mod.value='{$BUTTON.action}'" {$BUTTON.disabled}>&nbsp;
 {/foreach}
 <br><br>
 <table width="100%" cellspacing="0" cellpadding="0">
  {foreach from=$DATA item=ENTRY name=ENTRYTABLE}
     <tr>
      <td>{$ENTRY.creation_date|date_format:"%d.%m.%Y %H:%M:%S"}<br>{$ENTRY.name}</td>
      <td align="right" nowrap>{$ENTRY.email|email} | {$ENTRY.website|website}</td>
     </tr>
     <tr>
     <td colspan="2">{$ENTRY.comment|nl2br|badwords:$BADWORDREPLACE:$BADWORDLIST:$BADWORDS|emoticons:$EMOTICONPATH:$EMOTICONLIST:$EMOTICONS}</td>
     </tr>
     <tr>
      <td colspan="2">&nbsp;</td>
     </tr>
  {/foreach}
 </table>
 <br>
 {include file="includes/listnavigator.tpl"} 
</form>