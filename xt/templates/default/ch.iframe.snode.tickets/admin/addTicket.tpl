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
formatResult: formatResult

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
		return row[1] + " (<strong>id: " + row[0] + "</strong>)";
	}
	function formatResult(row) {
		return row[1];
	}

{/literal}
</script>
{/if}
<form method="post" enctype="multipart/form-data">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Client infromations"|translate}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
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
}<input id="ac" value="{"Search..."|translate}" onclick="this.value='';">
  </td>
 </tr>
 <tr>
  <td class="left">{"E-Mail report"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_mail_report">
  	<option value="0" style="background-color:red;">{"Off"|translate}</option>
  	<option value="1" style="background-color:green;">{"On"|translate}</option>
  </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Client check"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_client_check">
  	<option value="0" style="background-color:red;">{"No review by the customers"|translate}</option>
  	<option value="1" style="background-color:green;">{"Review by the customers"|translate}</option>
  </select>
  </td>
 </tr>
 <td class="view_header" colspan="2">
   <span class="title">{"Ticket infromations"|translate}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" value="{$xt8100_admin.title}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="6" cols="65">{$DATA.description}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"To do until"|translate} (d.m.y)</td>
  <td class="right"><input type="text" name="x{$BASEID}_date_str" id="x{$BASEID}_date_str" value="{$ARTICLE.date|date_format:"%d.%m.%Y"}" size="12" />
    {include file="includes/widgets/datepicker.tpl" relative="date_str"}
  <input type="hidden" name="x{$BASEID}_date" value="{$ARTICLE.date}" /> {html_select_time use_24_hours=true minute_interval=15}
  </td>
 </tr>
 <tr>
  <td class="left">{"Priority"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_priority">
  {foreach item=P from=$xt8100_admin.priorities key=PID}
  	<option value="{$PID}">{$P|translate}</option>
  {/foreach}
  </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Estimated effort"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_mail_report_tmp" onchange="document.getElementById('work_time').value=this.options[this.selectedIndex].value">
  	<option value="5">5 {"Minutes"|translate}</option>
  	<option value="15">15 {"Minutes"|translate}</option>
  	<option value="30">30 {"Minutes"|translate}</option>
  	<option value="45">45 {"Minutes"|translate}</option>
  	<option value="60">1 {"Hour"|translate}</option>
  	<option value="120">2 {"Hours"|translate}</option>
  	<option value="240">4 {"Hours"|translate}</option>
  	<option value="480">8 {"Hours"|translate}</option>
  </select> &nbsp;<input type="text" name="x{$BASEID}_work_time" id="work_time" value="{$xt8100_admin.work_time|default:"5"}" size="5"> {"Minutes"|translate}
  </td>
 </tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Workflow"|translate}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
  <tr>
  <td class="left">{"Supervisor"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_supervisor">
  {foreach item=USER from=$xt8100_admin.users}
  	<option value="{$USER.id}" {if $USER.id == $xt8100_admin.supervisor}selected="selected"{/if}>{$USER.username}</option>
  {/foreach}
  </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Supervisor check"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_supervisor_check">
  	<option value="0" style="background-color:red;">{"No review by the supervisor"|translate}</option>
  	<option value="1" style="background-color:green;">{"Review by the supervisor"|translate}</option>
  </select>
  </td>
 </tr>
   <tr>
  <td class="left">{"Worker"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_worker">
  <option value="0">{"No assignment"|translate}</option>
  {foreach item=USER from=$xt8100_admin.users}
  	<option value="{$USER.id}" {if $USER.id == $xt8100_admin.worker}selected="selected"{/if}>{$USER.username}</option>
  {/foreach}
  </select>
  </td>
 </tr>
  <tr>
  <td class="left">{"Is the ticket billable?"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_billable">
  	<option value="1" selected="selected" style="background-color:green;">{"Billable"|translate}</option>
  	<option value="0" style="background-color:red;">{"Not billable"|translate}</option>
  </select>
  </td>
 </tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Files"|translate}</span>
  </td>
 </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Add a file"|translate}</td>
  <td class="right">
  <input type="file" size="36" name="file">
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_id" />
</form>
{include file="includes/editor.tpl"}
<script language="JavaScript">
window.parent.frames['master'].document.forms[1].submit();
</script>