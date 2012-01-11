<form method="POST">
{include file="includes/buttons.tpl" data=$ADD_STEP_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Step data"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title"></td>
 </tr>
 <tr>
  <td class="left">{"Into phase"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_phase">
    {foreach from=$PHASES item=PHASE}
    <option value="{$PHASE.phase_id}" {if $ACTIVE_PHASE == $PHASE.phase_id}selected{/if}>{$PHASE.title}</option>
    {/foreach}
   </select>
  </td>
 </tr>
</table>
</form>
