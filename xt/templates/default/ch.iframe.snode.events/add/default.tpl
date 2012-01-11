{if $ADDED == 1}<span style="color:green;">{"successfull added"|translate}</span>{else}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="edit">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Add event"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 
  <tr>
  <td class="adminleft">{"category"|translate}</td>
  <td class="adminright">
	<select name="x{$BASEID}_cat">
  {foreach from=$TDATA item=TREE}
  	{if $TREE.active == 1}
  	<option value="{$TREE.id}" {if $TREE.id == $EVENT.node_id}selected{/if} style="padding-left:{$TREE.level*20}px;">{$TREE.title}</option>
  	{/if}
  {/foreach}
  </select>
  </td>
 </tr>
 
 <tr>
  <td class="adminleft">{"Title"|translate}</td>
  <td class="adminright"><input type="text" name="x{$BASEID}_title" value="{$EVENT.title|htmlspecialchars}" size="42" /></td>
 </tr>
 <tr>
  <td class="adminleft">{"Introduction"|translate}</td>
  <td class="adminright">{toggle_editor id="introduction"}
  <textarea id="x{$BASEID}_introduction" name="x{$BASEID}_introduction" rows="4" cols="65">{$EVENT.introduction}</textarea></td>
 </tr>
 <tr>
  <td class="adminleft">{"Text"|translate}</td>
  <td class="adminright">{toggle_editor id="maintext"}
  <textarea id="x{$BASEID}_maintext" name="x{$BASEID}_maintext" rows="8" cols="65">{$EVENT.maintext}</textarea></td>
 </tr>
 

 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Data"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>

 <tr>
  <td class="adminleft">{"Address"|translate}<a name="addr_picker" /></td>
  <td class="adminright">
<select name="x{$BASEID}_address">
  <option value="0">{"no selection"|translate}</option>
  {foreach from=$ADDRESSES item=ADDRESS}
  	<option value="{$ADDRESS.id}" {if $ADDRESS.id == $EVENT.address}selected{/if}>{$ADDRESS.title}</option>
  {/foreach}
  </select>
</td>
 </tr>

 <tr>
  <td class="adminleft">{"Contact Person"|translate}</td>
  <td class="adminright">
  <select name="x{$BASEID}_contact_person_id">
  <option value="0">{"no selection"|translate}</option>
  {foreach from=$ADDRESSES item=ADDRESS}
  	<option value="{$ADDRESS.id}" {if $ADDRESS.id == $EVENT.contact_person_id}selected{/if}>{$ADDRESS.title}</option>
  {/foreach}
  </select>
  </td>
 </tr>

 <tr>
  <td class="adminleft">{"Date"|translate}<a name="date" /></td>
  <td class="adminright">
  <select  style="width:50px;" name="x{$BASEID}_select_day" onchange="document.getElementById('x{$BASEID}_day').value=document.getElementById('x{$BASEID}_select_day')[selectedIndex].value;document.forms[0].x{$BASEID}_action.value='useradd';document.forms[0].submit();" id="x{$BASEID}_select_day">
  {foreach from=$DAYS item=DAY}
    <option value="{$DAY}"{if $DAY == $DAY_SELECTED} selected{/if}>{$DAY}</option>
  {/foreach}
  </select>
  <select  style="width:50px;" name="x{$BASEID}_select_month" onchange="document.getElementById('x{$BASEID}_month').value=document.getElementById('x{$BASEID}_select_month')[selectedIndex].value;document.forms[0].x{$BASEID}_action.value='useradd';document.forms[0].submit();" id="x{$BASEID}_select_month">
  {foreach from=$MONTHS item=MONTH}
    <option value="{$MONTH}"{if $MONTH == $MONTH_SELECTED} selected{/if}>{$MONTH}</option>
  {/foreach}
  </select>
  <select style="width:50px;" name="x{$BASEID}_select_year" onchange="document.getElementById('x{$BASEID}_year').value=document.getElementById('x{$BASEID}_select_year')[selectedIndex].value;document.forms[0].x{$BASEID}_action.value='useradd';document.forms[0].submit();" id="x{$BASEID}_select_year">
  {foreach from=$YEARS item=YEAR}
    <option value="{$YEAR}"{if $YEAR == $YEAR_SELECTED} selected{/if}>{$YEAR}</option>
  {/foreach}
  </select>
  <input type="hidden" name="x{$BASEID}_day" id="x{$BASEID}_day" value="{$EVENT.from_date|date_format:"%e"}" />
  <input type="hidden" name="x{$BASEID}_month" id="x{$BASEID}_month" value="{$EVENT.from_date|date_format:"%m"}" />
  <input type="hidden" name="x{$BASEID}_year" id="x{$BASEID}_year" value="{$EVENT.from_date|date_format:"%Y"}" />
  </td>
 </tr>
 <tr>
  <td class="adminleft">{"Time"|translate}</td>
  <td class="adminright">
  <select style="width: 50px;" name="x{$BASEID}_select_start_hour" id="x{$BASEID}_select_start_hour" onchange="document.getElementById('x{$BASEID}_start_hour').value=document.getElementById('x{$BASEID}_select_start_hour')[selectedIndex].value;document.forms[0].x{$BASEID}_action.value='useradd';document.forms[0].submit();">
  {foreach from=$HOURS item=HOUR}
    <option value="{$HOUR}"{if $HOUR == $HOUR_SELECTED} selected{/if}>{$HOUR}</option>
  {/foreach}
  </select>

  <input type="hidden" name="x{$BASEID}_start_hour" value="{$EVENT.from_date|date_format:"%H"}" id="x{$BASEID}_start_hour" maxlength="2" />&nbsp;:&nbsp;<input type="text" style="width: 50px;" name="x{$BASEID}_start_min" value="00" id="start_min" maxlength="2" /></td>
 </tr>
 <tr>
  <td class="adminleft">{"Duration"|translate}</td>
  <td class="adminright"><input type="text" name="x{$BASEID}_duration" value="{$EVENT.duration}" />&nbsp;
  <select name="x{$BASEID}_duration_type">
    <option value="minutes"{if $EVENT.duration_type == 'minutes'} selected{/if}>{"Minute(s)"|translate}</option>
    <option value="hours"{if $EVENT.duration_type == 'hours'} selected{/if}>{"Hour(s)"|translate}</option>
    <option value="day"{if $EVENT.duration_type == 'day'} selected{/if}>{"Day(s)"|translate}</option>
    <option value="week"{if $EVENT.duration_type == 'week'} selected{/if}>{"Week(s)"|translate}</option>
  </select>
  </td>
 </tr>

 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Options"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>

 <tr>
    <td class="adminleft">{"Visitors"|translate}</td>
    <td class="adminright"><input type="text" value="{$EVENT.max_visitors}" name="x{$BASEID}_max_visitors" size="10" />
  </td>
 </tr>
  <tr>
  <td class="adminleft">{"costs"|translate}</td>
  <td class="adminright">{toggle_editor id="maintext"}
  <textarea id="x{$BASEID}_costs" name="x{$BASEID}_costs" rows="3" cols="65">{$EVENT.costs}</textarea></td>
 </tr>
 <tr>
    <td class="adminleft">{"Link"|translate}</td>
    <td class="adminright"><input onclick="showhideCheckbox('x{$BASEID}_haslink', 'x{$BASEID}_linktr');" type="checkbox" name="x{$BASEID}_haslink" id="x{$BASEID}_haslink"{if $EVENT.link !=""} checked{/if} /></td>
 </tr>
 <tr id="x{$BASEID}_linktr" style="display:{if $EVENT.link != ''} table-row{else} none{/if};">
    <td class="adminleft">{"URL"|translate}</td>
    <td class="adminright"><input type="text" value="{$EVENT.link}" name="x{$BASEID}_link" size="40" />&nbsp;
    <input type="checkbox" name="x{$BASEID}_link_external"{if $EVENT.link_external == 1} checked{/if} />&nbsp;{"New window"|translate}</td>
 </tr>
 <tr>
    <td class="adminleft">{"Allow registration"|translate}</td>
    <td class="adminright"><input onclick="showhideCheckbox('x{$BASEID}_allow_registration', 'x{$BASEID}_formtr');" type="checkbox" name="x{$BASEID}_allow_registration" id="x{$BASEID}_allow_registration"{if $EVENT.form > 0} checked{/if} /></td>
 </tr>

 <tr id="x{$BASEID}_formtr" style="display:{if $EVENT.form > 0} table-row{else} none{/if};">
  <td class="adminleft">{"Form"|translate}</td>
  <td class="adminright">
    <input type="text" value="{$EVENT.form_title}" name="x{$BASEID}_formtitle" size="40" class="disabled" readonly="yes" />
    <a href="javascript:popup('{$smarty.server.PHP_SELF}?TPL={$FORM_PICKER_TPL}&amp;x{$FORM_PICKER_BASE_ID}_field=x{$BASEID}_form&amp;x{$FORM_PICKER_BASE_ID}_form=edit&amp;x{$FORM_PICKER_BASE_ID}_titlefield=x{$BASEID}_formtitle',770,470,'picker');">
    <img src="{$XT_IMAGES}icons/form_add.png" title="{"Select form"|translate}" alt="{"Select a form"|translate}" /></a>
   <input type="hidden" value="{$EVENT.form}" id="x{$BASEID}_form" name="x{$BASEID}_form" />
   </td>
 </tr>

 <tr>
   <td colspan="2" style="text-align:right; padding:6px;"><input type="button" value="{"Save"|translate}" onclick="document.edit.submit();"/></td>
  </tr>
</table>

<input type="hidden" name="x{$BASEID}_delete_image" value="" />
{include file="ch.iframe.snode.events/admin/hiddenValues.tpl"}
{include file="includes/editor.tpl"}
<input type="hidden" name="x{$BASEID}_action" value="useradd"/>
</form>
{/if}