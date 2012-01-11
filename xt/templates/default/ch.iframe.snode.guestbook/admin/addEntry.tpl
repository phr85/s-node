<form method="POST" name="guestbook">
 {include file="includes/buttons.tpl" data=$BUTTONS}
 <table cellspacing="0" cellpadding="0" width="100%"> 
  <tr>
   <td class="left">{"Name"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_name" value="{$NAME}" size="40"></td>
  </tr>
  <tr>
   <td class="left">{"E-Mail"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_email" value="{$EMAIL}" size="40"></td>
  </tr>
  <tr>
   <td class="left">{"Website"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_website" value="{$WEBSITE}" size="40"></td>
  </tr>
  <tr>
   <td class="left">{"Comment"|translate}</td>
   <td class="right"><textarea name="x{$BASEID}_comment" rows="5" cols="50">{$COMMENT}</textarea></td>
 </table>
</form>