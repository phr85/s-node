<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <base href="http://{$smarty.server.SERVER_NAME}/" /> 
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>{"new entry"|translate}</title>
</head>
<body style="text-align: left; width: 50%; font-family: monospace;" >
<table style="text-align: left; width: 50%; font-family: monospace;" border="0" cellpadding="2" cellspacing="2">
  <tbody>
  <tr>
  	<td>{"name"|translate}</td>
  	<td>{$xt1500_add.name}</td>
  </tr>
  <tr>
  	<td>{"email address"|translate}</td>
  	<td>{$xt1500_add.email}</td>
  </tr>
  <tr>
  	<td>{"website"|translate}</td>
  	<td>{$xt1500_add.website}</td>
  </tr>
  <tr>
  	<td>{"Comment"|translate}</td>
  	<td>{$xt1500_add.comment}</td>
  </tr>
  <tr>
  	<td>{"Date"|translate}</td>
  	<td>{$xt1500_add.date|date_format:"%d.%m.%Y %H:%M"}</td>
  </tr>
  <tr>
  	<td>{"IP"|translate}</td>
  	<td>{$xt1500_add.ip}</td>
  </tr>
  </tbody>
</table>
{"Deactivate this comment"|translate}:<br/>
<a href="http://{$smarty.server.SERVER_NAME}/index.php?TPL=560&x1500_action=deactivateEntry&x1500_id={$xt1500_add.id}">http://{$smarty.server.SERVER_NAME}/index.php?TPL=560&x1500_action=deactivateEntry&x1500_id={$xt1500_add.id}</a><br/>
{"Delete this comment"|translate}:<br/>
<a href="http://{$smarty.server.SERVER_NAME}/index.php?TPL=560&x1500_action=deleteEntry&x1500_id={$xt1500_add.id}">http://{$smarty.server.SERVER_NAME}/index.php?TPL=560&x1500_action=deleteEntry&x1500_id={$xt1500_add.id}</a><br/>
</body>
</html>