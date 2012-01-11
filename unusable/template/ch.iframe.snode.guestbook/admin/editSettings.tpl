<form method="POST" name="guestbook"> 
 {include file="includes/buttons.tpl" data=$BUTTONS}
 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 6px;"> 
  <tr>
   <td colspan="2" class="table_header">{"Edit options"|translate}</td>
  </tr>
  <tr>
   <td class="left" width="200">{"E-Mail info"|translate}</td>
   <td class="right" onclick="showhideCheckbox('x{$BASEID}_infoemail','x{$BASEID}_email')"><input type="checkbox" name="x{$BASEID}_infoemail" value="1" {if $INFOEMAIL==1}checked{/if}></td>
  </tr>
  <tr id="x{$BASEID}_email" style="display: {if $INFOEMAIL==1}table-row{else}none{/if};">
   <td class="left" width="200">{"E-Mail"|translate} ({"required"|translate})</td>
   <td class="right"><input type="text" name="x{$BASEID}_email" value="{$EMAIL}" size="40"></td>
  </tr>
  <tr>
   <td class="left">{"Confirm entry"|translate}</td>
   <td class="right"><input type="checkbox" name="x{$BASEID}_confirm" value="1" {if $CONFIRM==1}checked{/if}></td>   
  </tr>
  <tr>
   <td class="left">{"Pagesplit"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_pagesplit" value="{$PAGESPLIT}" size="2"> {"max. 99"|translate}</td>   
  <tr>
   <td class="left">{"Html"|translate}</td>
   <td class="right"onclick="showhideCheckbox('x{$BASEID}_html','x{$BASEID}_htmltags')"><input type="checkbox" name="x{$BASEID}_html" value="1" {if $HTML==1}checked{/if}></td>      
  </tr>
  <tr id="x{$BASEID}_htmltags" style="display: {if $HTML==1}table-row{else}none{/if};">
   <td class="left" width="200">{"Allowed tags"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_htmltags" value="{$HTMLTAGS}" size="40"></td>
  </tr>  
  <tr>
   <td class="left">{"Emoticons"|translate}</td>
   <td class="right"><input type="checkbox" name="x{$BASEID}_emoticons" value="1" {if $EMOTICONS==1}checked{/if}></td>      
  </tr>
  <tr>
   <td class="left">{"IP-Blocking"|translate}</td>
   <td class="right" onclick="showhideCheckbox('x{$BASEID}_ipblocking','x{$BASEID}_ipblockinglist')"><input type="checkbox" name="x{$BASEID}_ipblocking" value="1" {if $IPBLOCKING==1}checked{/if}></td>      
  </tr>
  <tr id="x{$BASEID}_ipblockinglist" style="display: {if $IPBLOCKING==1}table-row{else}none{/if};">
   <td class="left">{"IP-Blocking list"|translate}<br>({"Separate with"|translate} ; )</td>
   <td class="right"><textarea name="x{$BASEID}_ipblockinglist" lefts="5" cols="50">{$IPBLOCKINGLIST}</textarea></td>
  </tr>
  <tr>
   <td class="left">{"Bad words"|translate}</td>
   <td class="right" onclick="showhideCheckbox('x{$BASEID}_badwords','x{$BASEID}_badwordreplace');showhideCheckbox('x{$BASEID}_badwords','x{$BASEID}_badwordlist')"><input type="checkbox" name="x{$BASEID}_badwords" value="1" {if $BADWORDS==1}checked{/if}></td>      
  </tr>
  <tr id="x{$BASEID}_badwordreplace" style="display: {if $BADWORDS==1}table-row{else}none{/if};">
   <td class="left">{"Bad word replace"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_badwordreplace" value="{$BADWORDREPLACE}" size="40"></td>
  </tr>
  <tr id="x{$BASEID}_badwordlist" style="display: {if $BADWORDS==1}table-row{else}none{/if};">
   <td class="left">{"Bad word list"|translate}<br>({"Separate with"|translate} ; )</td>
   <td class="right"><textarea name="x{$BASEID}_badwordlist" lefts="5" cols="50">{$BADWORDLIST}</textarea></td>
  </tr>
 </table>
</form>