{include file="includes/buttons.tpl" data=$BUTTONS}
<form name="searchform" id="searchform" method="POST" action="{$smarty.server.PHP_SELF}">
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="left" width="200" valign="top">
   {"Form"|translate}
   </td>
   <td class="right">
   <select name="x{$BASEID}_form">
   {foreach from=$DATA_FORMS item=FORM}
   		<option value="{$FORM.id}" {if $FORM.id == $SELECTED_FORM}selected{/if}>{$FORM.title}</option>
   {/foreach}
   </select>
  </td>
 </tr>
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

   {"Date"|translate}
   <input type="text" name="x{$BASEID}_sdate_str" id="x{$BASEID}_sdate_str" size="15" value="{$TIME.sdate_str}" class="default" maxlength="10">
    {include file="includes/widgets/datepicker.tpl" relative="sdate_str"}
   <input type="hidden" name="x{$BASEID}_sdate" value="{$TIME.sdate}">


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

   {"Date"|translate}
      <input type="text" name="x{$BASEID}_edate_str" id="x{$BASEID}_edate_str" size="15" value="{$TIME.edate_str}" class="default" maxlength="10">
    {include file="includes/widgets/datepicker.tpl" relative="edate_str"}
   <input type="hidden" name="x{$BASEID}_edate" value="{$TIME.edate}">
 </td>
 </tr>
  <tr>
  <td class="left" width="200" valign="top">
   {"Show empty forms"|translate}
   </td>
   <td class="right">
   <input type="checkbox" value="1" name="x{$BASEID}_showempty" {if $SHOW_EMPTY == 1}checked{/if}/>&nbsp;{"Show"|translate}
  </td>
 </tr>

</table>
<table width="100%">
  <tr>
    <td class="table_header" width="200">{"Form"|translate}</td>
    <td class="table_header">{"Form details"|translate}</td>
  </tr>
{foreach from=$DATA item=FORMS}
  <tr>
	<td class="left" width="200" valign="top">
	{$FORMS.title} ({$FORMS.form_id} {$FORMS.lang})<br/>
	{$FORMS.date_str}<br/>
	<a href="{$FORMS.referer}" target="_blank">{$FORMS.referer|truncate:40:"..."}</a>
	</td>
	<td class="right">
	{foreach from=$FORMS.elements item=ELEMENT_DATA}
		<b>{$ELEMENT_DATA.label} ({$ELEMENT_DATA.id}):</b>&nbsp;{$ELEMENT_DATA.value}<br/>
	{/foreach}
	</td>
  </tr>
{/foreach}
</table>
<input type="hidden" name="x{$BASEID}_action" value="searchFillouts"/>
<input type="hidden" name="TPL" value="7100">
<a href="javascript:document.forms['searchform'].TPL.value='7101';document.forms['searchform'].x7100_action.value='export';document.forms['searchform'].submit();">Liste als CSV exportieren</a>

</form>