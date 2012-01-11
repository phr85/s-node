<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <base href="http://{$smarty.server.SERVER_NAME}/" /> 
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>{"Thank you for your subscription"|translate}</title>
</head>
<body style="text-align: left; font-family: monospace;" >
<table style="text-align: left; width: 50%; font-family: monospace;" border="0" cellpadding="2" cellspacing="2">
  <tbody>
  <tr>
  	<td>{"E-Mail"|translate}</td>
  	<td>{$MAIL_DATA.email}</td>
  </tr>
  <tr>
  	<td>{"Name"|translate}</td>
  	<td>{$MAIL_DATA.firstname} {$MAIL_DATA.lastname}</td>
  </tr>
  </tbody>
</table>
<a href="http://{$smarty.server.SERVER_NAME}/index.php?TPL={$TPL}">{"Click here to cancel the subscription"|translate}</a>
</body>
</html>