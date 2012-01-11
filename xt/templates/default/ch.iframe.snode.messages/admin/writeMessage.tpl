<form method="POST" name="writemessage">
 {include file="includes/buttons.tpl" data=$WRITE_BUTTONS}
 <table cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td class="table_header" colspan="2">{"Write message"|translate}</td>
  </tr>
  <tr>
   <td class="left">{"Sender"|translate}</td>
   <td class="right"><input type="hidden" name="x{$BASEID}_sender">{$smarty.session.user.name}</td>
  </tr>
  <tr>
   <td class="left">{"Receiver/s"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_receiver" size="40" value="{if $MODE == 're'}{$RECEIVER}{/if}"></td>
  </tr>
  <tr>
   <td class="left">{"Priority"|translate}</td>
   <td class="right">
    <select name="x{$BASEID}_priority">
     <option value="0">{"Low"|translate}</option>
     <option value="1" selected>{"Normal"|translate}</option>
     <option value="2">{"High"|translate}</option>
    </select>
   </td>
  </tr>
  <tr>
   <td class="left">{"Subject"|translate}</td>
   <td class="right" style="color: black;"><input type="text" name="x{$BASEID}_subject" size="40" value="{if $SUBJECT != ''}{if $MODE == 'fwd'}Fwd{else}Re{/if}: {/if}{$SUBJECT}"></td>
  </tr>
  <tr>
   <td class="left">{"Text"|translate}</td>
   <td class="right"><textarea name="x{$BASEID}_text" cols="50" rows="10"></textarea></td>
  </tr>
 </table>
 <input type="hidden" name="x{$BASEID}_message_flow" value="{$MESSAGE_FLOW}">
 <input type="hidden" name="x{$BASEID}_parent_id" value="{$PARENT_ID}">
 <input type="hidden" name="x{$BASEID}_id" value="">
</form>