{* Autocompleter for adding clients*}
{if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor}
{XT_load_css file="autocomplete.css"}
{XT_load_js file="jquery.autocomplete.js"}
<script type="text/javascript">
{literal}
 $(document).ready(function(){
	var data = "Core Selectors Attributes Traversing Manipulation CSS Events Effects Ajax Utilities".split(" ");
$("#ac").autocomplete('ajax.php?package=ch.iframe.snode.addressmanager&module=AX_getaddressbytitle',
{
selectFirst: false,
formatItem: formatItem,
formatResult: formatResult,
width: 200
});
$("#ac").result(function(event, data, formatted) {
		if (data){
			//$(this).parent().next().find("input").val(data[1]);
			$("#x{/literal}{$BASEID}{literal}_client_id").attr('value',data[0]);
			$("#x{/literal}{$BASEID}{literal}_client_id_title").attr('value',data[1]);
		}
	});
});

function formatItem(row) {
		return row[1];
	}
	function formatResult(row) {
		return row[1];
	}

{/literal}
</script>
{/if}
<form method="post" enctype="multipart/form-data">
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="true"}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Client infromations"|translate}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 

 {if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor}
 <tr>
  <td class="left">{"Client"|translate}</td>
  <td class="right">
  
  
  {xt_getaddresses assign="CLIENT" id=$xt8100_admin.data.client_id}
  <input type="text" id="x{$BASEID}_client_id_title"  value="{$CLIENT.title}" readonly="readonly"/><input type="hidden" id="x{$BASEID}_client_id" name="x{$BASEID}_client_id" value="{$xt8100_admin.data.client_id}"/>
  {actionPopUp
    icon="breakpoint_add.png"
    title="Pick an address"|translate
    TPL=281
    BASEID=7400
    form="0"
    name="picker"
    fieldBaseId=$BASEID
    fieldName="client_id"
}
<input id="ac" value="{"Search..."|translate}" onclick="this.value='';">
  </td>
 </tr>
 {else}
 	 <tr>
  <td class="left">{"Client"|translate}</td>
  <td class="right">
  {xt_getaddresses assign="CLIENT" id=$xt8100_admin.data.client_id}
  {$CLIENT.title|default:""} {if $CLIENT.user_id > 0}({$CLIENT.user_id|xt_getUserProperties:"username"}){/if}<br/>
  {$CLIENT.firstName|default:""} {$CLIENT.lastName}<br/>
  {$CLIENT.street|default:""}<br/>
  {$CLIENT.postalCode|default:""} {$CLIENT.city|default:""}<br/>
  {$CLIENT.country|xt_getcountry|default:""}<br/>
  {if $CLIENT.email != ""}<a href="mailto:{$CLIENT.email}">{$CLIENT.email}</a>{/if}
  </td>
 </tr>
 {/if}
 
 
 {if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor}
 <tr>
  <td class="left">{"E-Mail report"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_mail_report">
  	<option value="0" style="background-color:red;"{if 0 == $xt8100_admin.data.mail_report} selected="selected"{/if}>{"Off"|translate}</option>
  	<option value="1" style="background-color:green;"{if 1 == $xt8100_admin.data.mail_report} selected="selected"{/if}>{"On"|translate}</option>
  </select>
  </td>
 </tr>
 {else}
  <tr>
  <td class="left">{"E-Mail report"|translate}</td>
  <td class="right">
  	{if 0 == $xt8100_admin.data.mail_report}{"set off"|translate}{/if}
  	{if 1 == $xt8100_admin.data.mail_report}{"set on"|translate}{/if}
  </td>
 </tr>
 {/if}
 
 
 {if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor}
 <tr>
  <td class="left">{"Client check"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_client_check">
  	<option value="0" style="background-color:red;"{if 0 == $xt8100_admin.data.client_check} selected="selected"{/if}>{"No review by the customers"|translate}</option>
  	<option value="1" style="background-color:green;"{if 1 == $xt8100_admin.data.client_check} selected="selected"{/if}>{"Review by the customers"|translate}</option>
  </select>
  {if  1 == $xt8100_admin.data.client_check}
  	<br/>
  	{if 0 == $xt8100_admin.data.checked_by_client}<img src="images/icons/tickets/emoticon_unhappy.png"/> {"Client has not checked the ticket"|translate}{/if}
  	{if 1 == $xt8100_admin.data.checked_by_client}<img src="images/icons/tickets/emoticon_grin.png"/>{"Client marked ticket as checked"|translate}{/if}
  	{/if}
  </td>
 </tr>
  {else}
 <tr>
  <td class="left">{"Client check"|translate}</td>
  <td class="right">
  	{if 0 == $xt8100_admin.data.client_check}{"set off"|translate}{/if}
  	{if 1 == $xt8100_admin.data.client_check}{"set on"|translate}{/if}
  	{if  1 == $xt8100_admin.data.client_check}
  	<br/>
  	{if 0 == $xt8100_admin.data.checked_by_client}<img src="images/icons/tickets/emoticon_unhappy.png"/> {"Client has not checked the ticket"|translate}{/if}
  	{if 1 == $xt8100_admin.data.checked_by_client}<img src="images/icons/tickets/emoticon_grin.png"/>{"Client marked ticket as checked"|translate}{/if}
  	{/if}
  </td>
 </tr>
 {/if}
 
 
  <td class="view_header" colspan="2">
   <span class="title">{"Ticket infromations"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
{if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor}
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" value="{$xt8100_admin.data.title}" size="42"></td>
 </tr>
{else}
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" value="{$xt8100_admin.data.title}" size="42"  disabled=" disabled"></td>
 </tr>
{/if}

{if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor}
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="6" cols="65">{$xt8100_admin.data.description}</textarea></td>
 </tr>
 {else}
  <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">
  <div style="border: 1px solid #C2DAF9; padding: 5px;">{$xt8100_admin.data.description}</div></td>
 </tr>
 {/if}

{if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor} 
 <tr>
  <td class="left">{"To do until"|translate} (d.m.y)</td>
  <td class="right"><input type="text" name="x{$BASEID}_date_str" id="x{$BASEID}_date_str" value="{$xt8100_admin.data.date|date_format:"%d.%m.%Y"}" size="12" />
    {include file="includes/widgets/datepicker.tpl" relative="date_str"}
  <input type="hidden" name="x{$BASEID}_date" value="{$ARTICLE.date}" /> {html_select_time use_24_hours=true time=$xt8100_admin.data.date minute_interval=15}
  </td>
 </tr>
{else}
 <tr>
  <td class="left">{"To do until"|translate} (d.m.y)</td>
  <td class="right">
  {$xt8100_admin.data.date|date_format:"%d.%m.%Y %H:%M"}
  </td>
 </tr>
{/if}

{if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor} 
 <tr>
  <td class="left">{"Priority"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_priority">
  {foreach item=P from=$xt8100_admin.priorities key=PID}
  	<option value="{$PID}"{if $PID == $xt8100_admin.data.priority} selected="selected"{/if}>{$P|translate}</option>
  {/foreach}
  </select>
  </td>
 </tr>
 {else}
  <tr>
  <td class="left">{"Priority"|translate}</td>
  <td class="right">
  {foreach item=P from=$xt8100_admin.priorities key=PID}
  	{if $PID == $xt8100_admin.data.priority}{$P|translate}{/if}
  {/foreach}
  </td>
 </tr>
 {/if}
 
{if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor}
 <tr>
  <td class="left">{"Estimated effort"|translate}</td>
  <td class="right">
  <input type="text" name="x{$BASEID}_work_time" id="work_time" value="{$xt8100_admin.data.work_time|default:"5"}" size="5"> {"Minutes"|translate}
  </td>
 </tr>
{else}
 <tr>
  <td class="left">{"Estimated effort"|translate}</td>
  <td class="right">
  {$xt8100_admin.data.work_time|default:"0"} {"Minutes"|translate}
  </td>
 </tr>
{/if}

<td class="view_header" colspan="2">
   <span class="title">{"Status"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 
  <tr>
  <td class="left">{"Current status"|translate}</td>
  <td class="right">
   {if $xt8100_admin.data.status == 0}<img src="images/icons/tickets/open.png" alt="{"status_0"|translate}"/> {"status_0"|translate}{/if}
   {if $xt8100_admin.data.status == 1}<img src="images/icons/tickets/running.png" alt="{"status_1"|translate}"/> {"status_1"|translate}{/if}
   {if $xt8100_admin.data.status == 2}<img src="images/icons/tickets/onhold.png" alt="{"status_2"|translate}"/> {"status_2"|translate}{/if}
   {if $xt8100_admin.data.status == 3}<img src="images/icons/tickets/rejected.png" alt="{"status_3"|translate}"/> {"status_3"|translate}{/if}
   {if $xt8100_admin.data.status == 4}<img src="images/icons/tickets/stopped.png" alt="{"status_4"|translate}"/> {"status_4"|translate}{/if}
   {if $xt8100_admin.data.status == 5}<img src="images/icons/tickets/done.png" alt="{"status_5"|translate}"/> {"status_5"|translate}{/if}
  </td>
 </tr>
 {if ($xt8100_admin.my_userid == $xt8100_admin.data.worker || $xt8100_admin.my_userid == $xt8100_admin.data.supervisor) && $xt8100_admin.data.status != 0 }
 <tr>
  <td class="left">{"Set new status"|translate}</td>
  <td class="right">{"1. Comment the statuschange"|translate}<br/>
  <textarea id="status_comment" name="x{$BASEID}_status_comment" rows="4" cols="65" onkeyup="{literal}tmpstr = this.value.replace (/^\s+/, '').replace (/\s+$/, '');; if(tmpstr.length < 4){ document.getElementById('newstatus').style.display='none'; }else{document.getElementById('newstatus').style.display='inline';}{/literal}"></textarea><br/>
  <div id="newstatus" style="display:none;" >
  {"2. Choose the new status"|translate}<br/>
  <select name="newstatus" onchange="this.form.x{$BASEID}_status.value=this.options[this.selectedIndex].value;this.form.submit();">
  	<option value="">{"--"|translate}</option>
  	{if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor}
  	{if 1 != $xt8100_admin.data.status}<option value="0">{"status_0"|translate}</option>{/if}
	{/if}
	{if 1 != $xt8100_admin.data.status}<option value="1">{"status_1"|translate}</option>{/if}
	{if 2 != $xt8100_admin.data.status}<option value="2">{"status_2"|translate}</option>{/if}
	{if 3 != $xt8100_admin.data.status}<option value="3">{"status_3"|translate}</option>{/if}
	{if 4 != $xt8100_admin.data.status}<option value="4">{"status_4"|translate}</option>{/if}
	{if 5 != $xt8100_admin.data.status}<option value="5">{"status_5"|translate}</option>{/if}
  </select>
  </div>
  </td>
 </tr>
 {/if}

 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Workflow"|translate}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 
 {if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor}
 <tr>
  <td class="left">{"Supervisor"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_supervisor">
  {foreach item=USER from=$xt8100_admin.users}
  	<option value="{$USER.id}" {if $USER.id == $xt8100_admin.data.supervisor}selected="selected"{/if}>{$USER.username}</option>
  {/foreach}
  </select>
  </td>
 </tr>
 {else}
 <tr>
  <td class="left">{"Supervisor"|translate}</td>
  <td class="right">
	{$xt8100_admin.data.supervisor|xt_getUserProperties:"username"}
  </td>
 </tr>
 {/if}
 
{if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor}
<tr>
  <td class="left">{"Supervisor check"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_supervisor_check">
  	<option value="0" style="background-color:red;"{if 0 == $xt8100_admin.data.supervisor_check} selected="selected"{/if}>{"No review by the supervisor"|translate}</option>
  	<option value="1" style="background-color:green;"{if 1 == $xt8100_admin.data.supervisor_check} selected="selected"{/if}>{"Review by the supervisor"|translate}</option>
  </select>
  {if  1 == $xt8100_admin.data.supervisor_check}
  	<br/>
  	{if 0 == $xt8100_admin.data.checked_by_supervisor}<img src="images/icons/tickets/emoticon_unhappy.png"/> {"Supervisor has not checked the ticket"|translate}{/if}
  	{if 1 == $xt8100_admin.data.checked_by_supervisor}<img src="images/icons/tickets/emoticon_grin.png"/>{"Supervisor marked ticket as checked"|translate}{/if}
  {/if}
  </td>
</tr>
{else}
<tr>
  <td class="left">{"Supervisor check"|translate}</td>
  <td class="right">
	{if 0 == $xt8100_admin.data.supervisor_check}{"set off"|translate}{/if}
  {if 1 == $xt8100_admin.data.supervisor_check}{"set on"|translate}{/if}
  {if  1 == $xt8100_admin.data.supervisor_check}
  	<br/>
  	{if 0 == $xt8100_admin.data.checked_by_supervisor}<img src="images/icons/tickets/emoticon_unhappy.png"/> {"Supervisor has not checked the ticket"|translate}{/if}
  	{if 1 == $xt8100_admin.data.checked_by_supervisor}<img src="images/icons/tickets/emoticon_grin.png"/>{"Supervisor marked ticket as checked"|translate}{/if}
  {/if}
  </td>
</tr> 
{/if}

{if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor}
<tr>
  <td class="left">{"Worker"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_worker">
  <option value="0">{"No assignment"|translate}</option>
  {foreach item=USER from=$xt8100_admin.users}
  	<option value="{$USER.id}" {if $USER.id == $xt8100_admin.data.worker}selected="selected"{/if}>{$USER.username}</option>
  {/foreach}
  </select>
  </td>
</tr>
{elseif $xt8100_admin.data.worker != 0}
<tr>
  <td class="left">{"Worker"|translate}</td>
  <td class="right">
  {$xt8100_admin.data.worker|xt_getUserProperties:"username"}
  </td>
</tr>
{/if}

{if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor}
<tr>
  <td class="left">{"Is the ticket billable?"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_billable">
  	<option value="0" style="background-color:red;"{if 0 == $xt8100_admin.data.billable} selected="selected"{/if}>{"Not billable"|translate}</option>
  	<option value="1" style="background-color:green;"{if 1 == $xt8100_admin.data.billable} selected="selected"{/if}>{"Billable"|translate}</option>
  </select>
  </td>
</tr>
{else}
<tr>
  <td class="left">{"Is the ticket billable?"|translate}</td>
  <td class="right">
	{if 0 == $xt8100_admin.data.billable}{"Not billable"|translate}{/if}
  {if 1 == $xt8100_admin.data.billable}{"Billable"|translate}{/if}
  </td>
</tr> 
{/if}
<tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Files"|translate}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {if $xt8100_admin.files|@count > 0}
 <tr>
  <td class="left">{"Files"|translate}</td>
  <td class="right">
  <table cellspacing="0" cellpadding="0" width="100%">
  {foreach item=FILE from=$xt8100_admin.files}
  	<tr class="{cycle values="row_a,row_b"}">
  	<td class="row" width="20">{$FILE.name|icon}</td>
  	<td class="row">
  	{actionLink
           action="download"
           text=$FILE.name
           form=0
           file=$FILE.name
           target="slave1"
           id=$xt8100_admin.data.id
           title="Download file"
       }
       
       </td>
       <td class="row" width="40">{$FILE.size|format_filesize}</td>
       <td class="row" width="90">
       {actionIcon
           action="download"
           icon="download.png"
           form=0
           target="slave1"
           file=$FILE.name
           id=$xt8100_admin.data.id
           title="Download file"
       }
       {if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor || $xt8100_admin.my_userid == $xt8100_admin.data.worker}
       {actionIcon
           action="deleteFile"
           icon="delete.png"
           form=0
           target="slave1"
           file=$FILE.name
           id=$xt8100_admin.data.id
           title="Delete file"
           ask="Are you sure to delete this file?"
       }
       {/if}
       </td>
	</tr>
  {/foreach}
  </table>
  </td>
 </tr>
 {/if}
 {if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor || $xt8100_admin.my_userid == $xt8100_admin.data.worker}
 <tr>
  <td class="left">{"Add a file"|translate}</td>
  <td class="right">
  <input type="file" size="36" name="file">
  </td>
 </tr>
 {/if}
</table>
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="true"}
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
  <td class="view_header" colspan="2">
   <span class="title">{"History"|translate}</span> <a href="#add_effort"><img src="images/icons/add.png"/></a>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
</tr>
<tr>
  <td colspan="2">
  <table cellspacing="0" cellpadding="0" width="100%">
   {assign var=total value=0}
   {foreach item=WT from=$xt8100_admin.work_time}
   <tr class="{cycle values="row_a,row_b"}">
   	<td class="row" width="30">{if $WT.type == 0}{actionIcon
           action="deleteEffort"
           icon="delete.png"
           form=0
           target="slave1"
           effort_id=$WT.id
           id=$xt8100_admin.data.id
           title="Delete effort"
           ask="Are you sure to delete this effort?"
       }{/if}</td>
   		
   		{if $WT.type == 0}<td class="row" width="60">{math equation="(x - y) / 60" x=$WT.end_date y=$WT.start_date assign=effort format="%.0f"}{$effort} {"Minutes"|translate}{math equation="x + y" x=$total y=$effort assign=total}</td>
   		<td class="row">{$WT.description}</td>{else}
   		<td class="row" colspan="2">{$WT.description}</td>
   		{/if}
   		<td class="row" width="120">{$WT.start_date|date_format:"%d.%m.%Y %H:%M"} ({$WT.worker|xt_getUserProperties:"username"})</td>
   </tr>
   {/foreach}
   <tr class="{cycle values="row_a,row_b"}">
   <td class="row" colspan="4"><b>{"Total"|translate} {math equation="x/60" x=$total assign="hours" format="%.0f"}{$hours} {"Hours"|translate} {math equation="abs(x - (y*60))" x=$total y=$hours assign="minutes" format="%.0f"}{$minutes} {"Minutes"|translate}</b></td>
   </tr>
  </table>
  </td>
</tr>
<tr>
  <td class="left">{"Effort"|translate}<a name="add_effort"/></td>
  <td class="right">
  <select id="hours" onchange="document.getElementById('wt').value = ((parseInt(this.value) * 60) + parseInt(document.getElementById('minutes').value))">
    <option value="0">0</option>
    {section name=foo loop=20}
    <option value="{counter}">{$smarty.section.foo.iteration}</option>
	{/section}
  </select> {"Hours"|translate} 
   <select id="minutes"  onchange="document.getElementById('wt').value = ((parseInt(document.getElementById('hours').value) * 60) + parseInt(document.getElementById('minutes').value))">
    <option value="0">0</option>
    <option value="15">15</option>
    <option value="30">30</option>
    <option value="45">45</option>    
  </select> {"Minutes"|translate}
  <input id="wt" type="hidden" name="x{$BASEID}_work_time_add" value="15" size="5">
  </td>
</tr>
<tr>
  <td class="left">{"Comment"|translate}</td>
  <td class="right">
 	<textarea id="x{$BASEID}_comment" name="x{$BASEID}_comment" rows="6" cols="65"></textarea>
  </td>
 </tr>
 </table>
<input type="hidden" name="x{$BASEID}_id" value="{$xt8100_admin.data.id}"/>
<input type="hidden" name="x{$BASEID}_effort_id" value="0"/>
<input type="hidden" name="x{$BASEID}_status" value=""/>
<input type="hidden" name="x{$BASEID}_file" value=""/>
<input type="hidden" name="x{$BASEID}_old_status" value="{$xt8100_admin.data.status}"/>
<input type="hidden" name="x{$BASEID}_action" value="{if $xt8100_admin.my_userid == $xt8100_admin.data.supervisor}ticketSaveSupervisor{else}TicketSaveWorker{/if}"/>
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="true"}
</form>
{include file="includes/editor.tpl"}
<script language="JavaScript">
window.parent.frames['master'].document.forms[1].submit();
</script>