<script type="text/javascript" src="/scripts/datepicker.js"></script>
{if $xt8100_user_add.ticket_added == 1}<span style="color:green;">{"Ticket added"|translate}</span>{/if}
{if count($xt8100_user_add.errors) > 0}
<div id="errorwrapper">
<div id="error">
 {foreach from=$xt8100_user_add.errors item=ERROR}
 	{$ERROR|translate}<br/>
  {/foreach}
  <script>
  {literal}
  warnuser();
  function warnuser() {
  	document.getElementById('errorwrapper').style.top=(window.outerHeight/2 - 200) + 'px';
  	document.getElementById('errorwrapper').style.left=(window.outerWidth/2 - 230) + 'px';
  	 new Effect.Highlight('error');
 	 window.setTimeout('warnuser();',5000);
  }
  function closeError() {
  	new Effect.SwitchOff('errorwrapper');
  }
  {/literal}
  </script>
  <a href="javascript:closeError();">{"Close"|translate}</a>
</div>
</div>
{/if}
<form method="post">
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
  <td class="adminleft">{"Client"|translate}</td>
  <td class="adminright">
  <select name="x{$BASEID}_client_id">
  {foreach item=CLIENT from=$xt8100_user_add.addresses}
  	<option value="{$CLIENT.id}"{if $CLIENT.id == $xt8100_user_add.client_id} selected="selected"{/if}>{$CLIENT.title} {if $CLIENT.title == ""}{$CLIENT.firstName} {$CLIENT.lastName}{/if} {if $CLIENT.user_id > 0}({$CLIENT.user_id|xt_getUserProperties:"username"}){/if}</option>
  {/foreach}
  </select>
  </td>
 </tr>
 <tr>
  <td class="adminleft">{"E-Mail report"|translate}</td>
  <td class="adminright">
  <select name="x{$BASEID}_mail_report">
  	<option value="0" style="background-color:red;"{if 0 == $xt8100_user_add.mail_report} selected="selected"{/if}>{"Off"|translate}</option>
  	<option value="1" style="background-color:green;"{if 1 == $xt8100_user_add.mail_report} selected="selected"{/if}>{"On"|translate}</option>
  </select>
  </td>
 </tr>
  <tr>
  <td class="adminleft">{"Client check"|translate}</td>
  <td class="adminright">
  <select name="x{$BASEID}_client_check">
  	<option value="0" style="background-color:red;"{if 0 == $xt8100_user_add.client_check} selected="selected"{/if}>{"No review by the customers"|translate}</option>
  	<option value="1" style="background-color:green;"{if 1 == $xt8100_user_add.client_check} selected="selected"{/if}>{"Review by the customers"|translate}</option>
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
  <td class="adminleft">{"Title"|translate}</td>
  <td class="adminright"><input type="text" name="x{$BASEID}_title" value="{$xt8100_user_add.title}" size="42"></td>
 </tr>
 <tr>
  <td class="adminleft">{"Description"|translate}</td>
  <td class="adminright">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="6" cols="65">{$xt8100_user_add.description}</textarea></td>
 </tr>
 <tr>
  <td class="adminleft">{"To do until"|translate} (d.m.y)</td>
  <td class="adminright"><input type="text" name="x{$BASEID}_date_str" id="x{$BASEID}_date_str" value="{$xt8100_user_add.date|date_format:"%d.%m.%Y"}" size="12" />
    {include file="includes/widgets/datepicker.tpl" relative="date_str"}
  <input type="hidden" name="x{$BASEID}_date" value="{$ARTICLE.date}" /> {html_select_time use_24_hours=true time=$xt8100_user_add.date minute_interval=15}
  </td>
 </tr>
 <tr>
  <td class="adminleft">{"Priority"|translate}</td>
  <td class="adminright">
  <select name="x{$BASEID}_priority">
  {foreach item=P from=$xt8100_user_add.priorities key=PID}
  	<option value="{$PID}"{if $PID==$xt8100_user_add.priority} selected="selected"{/if}>{$P|translate}</option>
  {/foreach}
  </select>
  </td>
 </tr>
  <tr>
 	<td>&nbsp;</td>
 	<td>&nbsp;</td>
 </tr>
 <tr>
 	<td><input type="submit" value="{"Submit"|translate}"/></td>
 	<td>&nbsp;</td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_action" value="addTicketClient" />
<input type="hidden" name="x{$BASEID}_work_time" value="0" />
{include file="includes/editor.tpl"}
</form>