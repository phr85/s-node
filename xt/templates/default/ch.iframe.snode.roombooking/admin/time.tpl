<h2>{"Time"|translate}</h2>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
  <td class="left" width="200" valign="top">
   {"From"|translate}
  </td>
  <td class="right">{"Hour"|translate}
   <select name="x{$BASEID}_hstart" class="default">
{foreach from=$TIME.shour key=HOUR item=SHOUR}
   <option value="{$HOUR}" {if $SHOUR}selected="selected"{/if}>{$HOUR}</option>
{/foreach}
   </select>&nbsp;

   {"Minute"|translate}
   <select name="x{$BASEID}_mstart" class="default">
   {foreach from=$TIME.smin key=MIN item=SMIN}
    <option value="{$MIN}" {if $SMIN}selected="selected"{/if}>{$MIN}</option>
   {/foreach}
   </select>

   <br />{"Date"|translate}
   <input type="text" name="x{$BASEID}_sdate_str" size="15" value="{$TIME.sdate_str}" class="default" maxlength="10" readonly>
   <input type="hidden" name="x{$BASEID}_sdate" value="{$TIME.sdate}">


  <a href="#date" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$DATE_PICKER_TPL}&x{$BASEID}_date={$TIME.sdate}&x270_field=x{$BASEID}_s',210,260,'startDate');">
     <img src="images/icons/calendar.png" width="16" height="16" border="0" alt="{'Calendar'|translate}" title="{'Opens the calendar'|translate}" /></a>

  </td>
 </tr>
 <tr>
  <td class="left" width="200" valign="top">
   {"Until"|translate}
  </td>
  <td class="right">{"Hour"|translate}
   <select name="x{$BASEID}_hend" class="default">
   {foreach from=$TIME.ehour key=HOUR item=EHOUR}
   <option value="{$HOUR}" {if $EHOUR}selected="selected"{/if}>{$HOUR}</option>
   {/foreach}
   </select>&nbsp;
   {"Minute"|translate}
   <select name="x{$BASEID}_mend" class="default">
 {foreach from=$TIME.emin key=MIN item=EMIN}
    <option value="{$MIN}" {if $EMIN}selected="selected"{/if}>{$MIN}</option>
   {/foreach}
   </select>

   <br />{"Date"|translate}
   <input type="text" name="x{$BASEID}_edate_str" size="15" value="{$TIME.edate_str}" class="default" maxlength="10" readonly>
   <input type="hidden" name="x{$BASEID}_edate" value="{$TIME.edate}">

  <a href="#date" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$DATE_PICKER_TPL}&x270_date={$TIME.edate}&x270_field=x{$BASEID}_e',210,260,'endDate');">
     <img src="images/icons/calendar.png" width="16" height="16" border="0" alt="{'Calendar'|translate}" title="{'Opens the calendar'|translate}" /></a>
 </td>
 </tr>

 </table>
