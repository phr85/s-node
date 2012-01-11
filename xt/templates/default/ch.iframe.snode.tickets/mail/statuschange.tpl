<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <base href="http://{$smarty.server.SERVER_NAME}/" /> 
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>{$xt8100_mail.title}</title>
</head>
<body style="text-align: left; font-family: monospace;" >
<table style="text-align: left; width: 50%; font-family: monospace;" border="0" cellpadding="2" cellspacing="2">
  <tbody>
  	<tr style="background-color: {cycle values="#eeeeee,#dddddd"};">
  		<td>{"Status changed to"|translate}</td>
		<td>{$xt8100_mail.status_str|translate}</td>
  	</tr>
  	{if $xt8100_mail.worker > 0 && $xt8100_mail.worker > 0}
  	<tr style="background-color: {cycle values="#eeeeee,#dddddd"};">
  		<td>{"Worker"|translate}</td>
		<td>{$xt8100_mail.worker|xt_getUserProperties:"username"}</td>
  	</tr>
  	{else}
  	<tr style="background-color: {cycle values="#eeeeee,#dddddd"};">
  		<td>{"Worker"|translate}</td>
		<td>{"No assignment"|translate}</td>
  	</tr>
  	{/if}
  	{if $xt8100_mail.comment != ""}
  		<tr style="background-color: {cycle values="#eeeeee,#dddddd"};">
  		<td>{"Comment"|translate}</td>
		<td>{$xt8100_mail.comment}</td>
  	</tr>
  	{/if}
  	<tr style="background-color: {cycle values="#eeeeee,#dddddd"};">
  		<td>{"Title"|translate}</td>
		<td>{$xt8100_mail.title}</td>
  	</tr>
  	<tr style="background-color: {cycle values="#eeeeee,#dddddd"};">
  		<td>{"Client"|translate}</td>
		<td>
			  {xt_getaddresses assign="CLIENT" id=$xt8100_mail.client_id}
			  {$CLIENT.title|default:""} {if $CLIENT.user_id > 0}({$CLIENT.user_id|xt_getUserProperties:"username"}){/if}<br/>
			  {$CLIENT.firstName|default:""} {$CLIENT.lastName}<br/>
			  {$CLIENT.street|default:""}<br/>
			  {$CLIENT.postalCode|default:""} {$CLIENT.city|default:""}<br/>
			  {$CLIENT.country|xt_getcountry|default:""}<br/>
			  {if $CLIENT.email != ""}<a href="mailto:{$CLIENT.email}">{$CLIENT.email}</a>{/if}
		</td>
  	</tr>
	<tr style="background-color: {cycle values="#eeeeee,#dddddd"};">
		<td>{"Description"|translate}</td>
		<td><div style="border: 1px solid #C2DAF9; padding: 5px;">{$xt8100_mail.description}</div></td>
	</tr>
  	<tr style="background-color: {cycle values="#eeeeee,#dddddd"};">
  		<td>{"To do until"|translate}</td>
		<td>{$xt8100_mail.date|date_format:"%d.%m.%Y %H:%M"}</td>
  	</tr>
  	<tr style="background-color: {cycle values="#eeeeee,#dddddd"};">
  		<td>{"Priority"|translate}</td>
		<td>{foreach item=P from=$xt8100_mail.priorities key=PID}
  				{if $PID == $xt8100_admin.data.priority}{$P|translate}{/if}
  			{/foreach}
  		</td>
  	</tr>
  </tbody>
</table>
</body>
</html>