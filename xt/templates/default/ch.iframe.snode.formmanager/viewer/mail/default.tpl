<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <base href="http://{$smarty.server.SERVER_NAME}/" />
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>{$SUBJECT}</title>
</head>
<body>
<div style="font-family: monospace;">Sie haben ein Formular-Mail von {$smarty.server.SERVER_NAME} erhalten.<br />
Ausgefüllt von {$smarty.server.REMOTE_ADDR}</div><br /><br />
<table style="text-align: left; width: 100%; font-family: monospace;" border="0" cellpadding="2" cellspacing="2">
  <tbody>
		{foreach from=$ALL_FIELDS key=ELEMENT_ID item=INPUT name=I}
			{if $INPUT.element_type != 14}
				<tr>
				{if $INPUT.element_type == 8}
				<td colspan="2" style="background-color: #D1D1D1; font-weight:bold;">{$INPUT.label}</td>
				{elseif $INPUT.element_type == 6}
				<td colspan="2" style="background-color: rgb(238, 238, 238);">{$INPUT.label}</td>
				{else}
				<td style="background-color: rgb(238, 238, 238); width:30%;">{$INPUT.label} {if $INPUT.element_type != 8}{$INPUT.space}:</b></td>
				<td style="background-color: rgb(238, 238, 238); width:70%;">
				{foreach from=$INPUT_VALUES.$ELEMENT_ID item=VALUE name=inputvalues}
				{$VALUE}
				{if $smarty.foreach.inputvalues.last}
				{else}
				,
				{/if}
				{/foreach}
				{else}
				{/if}
				</td>
				{/if}
				</tr>
			{/if}
		{/foreach}
</tbody>
</table>
</body>
</html>