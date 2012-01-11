<form method="POST" name="addEntry">
 <table  width="100%" cellspacing="0" cellpadding="0"> 
  <tr>
   <td width="200" valign="top">{"Name"|translate}</td>
   <td><input type="text" name="x{$BASEID}_name" value="{$NAME}" size="40"></td>
  </tr>
  <tr>
   <td valign="top">{"E-Mail"|translate}</td>
   <td><input type="text" name="x{$BASEID}_email" value="{$EMAIL}" size="40"></td>
  </tr>
  <tr>
   <td valign="top">{"Website"|translate}</td>
   <td><input type="text" name="x{$BASEID}_website" value="{$WEBSITE}" size="40"></td>
  </tr>
  <tr>
   <td valign="top">{"Comment"|translate}</td>
   <td><textarea name="x{$BASEID}_comment" rows="5" cols="50">{$COMMENT}</textarea></td>
  </tr>
  <tr>
   <td valign="top">&nbsp;</td>
   <td>
     {foreach from=$BUTTONS item=BUTTON}
        <input type="submit" value="{$BUTTON.label}" name="submit_{$BUTTON.action}" class="{$BUTTON.class}" onclick="document.forms['addEntry'].x{$BASEID}_action.value='{$BUTTON.action}'" {$BUTTON.disabled}>&nbsp;
     {/foreach}   
   </td>
  </tr>
 </table>
 <input type="hidden" name="TPL" value="{$TPL}"> 
 <input type="hidden" name="x{$BASEID}_mod" value="add">
 <input type="hidden" name="x{$BASEID}_action" value="">
</form>