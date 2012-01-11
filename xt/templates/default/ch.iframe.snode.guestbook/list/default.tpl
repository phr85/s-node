{include file="includes/listnavigator.tpl"} <br />
 <table width="100%" cellspacing="0" cellpadding="0">
  {foreach from=$xt1500_list.data item=ENTRY name=ENTRYTABLE}
     <tr>
      <td class="guesttitle">{$ENTRY.creation_date|date_format:"%d.%m.%Y %H:%M:%S"}<br />{$ENTRY.name}</td>
      <td class="guesttitle" align="right" nowrap>{$ENTRY.email|email} {$ENTRY.website|website:"":"_blank"}</td>
     </tr>
     <tr>
     <td colspan="2" class="guest">{$ENTRY.comment|nl2br}</td>
     </tr>
     <tr><td colspan="2">&nbsp;</td> </tr>
  {/foreach}
 </table>


 <form method="POST" name="guestbook_list">
 <input type="hidden" name="TPL" value="{$TPL}">
 <input type="hidden" name="x{$BASEID}_mod" value="list">
 {foreach from=$BUTTONS item=BUTTON}
    <input type="submit" value="{$BUTTON.label}" name="submit_{$BUTTON.action}" class="{$BUTTON.class}" onclick="document.forms['guestbook_list'].x{$BASEID}_mod.value='{$BUTTON.action}'" {$BUTTON.disabled}>&nbsp;
 {/foreach}
 <br /><br />

 {include file="includes/listnavigator.tpl"}
</form>