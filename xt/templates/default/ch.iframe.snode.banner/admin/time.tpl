<h2>{"Time"|translate}</h2>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
  <td class="left" width="200" valign="top">
   {"From"|translate}
  </td>
  <td class="right">
  <input type="radio" name="x{$BASEID}_time_type" value="0" {if $TIME.type=="0"}checked{/if} />{"none"|translate}
  <input type="radio" name="x{$BASEID}_time_type" value="1" {if $TIME.type=="1"}checked{/if} />{"from"|translate}
  <input type="radio" name="x{$BASEID}_time_type" value="2" {if $TIME.type=="2"}checked{/if} />{"to"|translate}
  <input type="radio" name="x{$BASEID}_time_type" value="3" {if $TIME.type=="3"}checked{/if} />{"between"|translate}
 </td>
</tr>
{if $TIME.type=="1" || $TIME.type=="3"}
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
<input type="text" name="x{$BASEID}_sdate_str" id="x{$BASEID}_sdate_str" size="12" value="{$TIME.sdate_str}">
{include file="includes/widgets/datepicker.tpl" relative="sdate_str"}
   <input type="hidden" name="x{$BASEID}_sdate" value="{$TIME.sdate}">


  </td>
 </tr>
 {/if}
 {if $TIME.type=="2" || $TIME.type=="3"}
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
   <input type="text" name="x{$BASEID}_edate_str" id="x{$BASEID}_edate_str" size="15" value="{$TIME.edate_str}" class="default" maxlength="10" readonly>
   {include file="includes/widgets/datepicker.tpl" relative="edate_str"}
   <input type="hidden" name="x{$BASEID}_edate" value="{$TIME.edate}">
 </td>
 </tr>
 {/if}
</table>