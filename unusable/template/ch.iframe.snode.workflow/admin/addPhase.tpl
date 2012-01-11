<form method="POST">
{include file="includes/buttons.tpl" data=$ADD_PHASE_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Phase data"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title"></td>
 </tr>
 <tr>
  <td class="left">{"Position"|translate}</td>
  <td class="right">
   <input type="radio" name="x{$BASEID}_position" value="1" checked> {"At the end"|translate}
   <input type="radio" name="x{$BASEID}_position" value="2"> {"At the beginning"|translate}
   <input type="radio" name="x{$BASEID}_position" value="3"> {"After"|translate}
   <select name="x{$BASEID}_after">
    {foreach from=$PHASES item=PHASE}
    <option value="{$PHASE.position}">{$PHASE.title}</option>
    {/foreach}
   </select>
  </td>
 </tr>
</table>
</form>
