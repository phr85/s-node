<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <base href="http://{$smarty.server.SERVER_NAME}/" /> 
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>{$MAIL_DATA.comment.title}</title>
</head>
<body style="text-align: left; font-family: monospace;" >
<table style="text-align: left; width: 50%; font-family: monospace;" border="0" cellpadding="2" cellspacing="2">
  <tbody>
  <tr>
  	<td>{"User name"|translate}</td>
  	<td>{$MAIL_DATA.user.name}</td>
  </tr>
  <tr>
  	<td>{"User email"|translate}</td>
  	<td>{$MAIL_DATA.user.email}</td>
  </tr>
  <tr>
  	<td>{"Title"|translate}</td>
  	<td>{$MAIL_DATA.comment.title}</td>
  </tr>
  <tr>
  	<td>{"Comment"|translate}</td>
  	<td>{$MAIL_DATA.comment.comment}</td>
  </tr>
  <tr>
  	<td>{"Date"|translate}</td>
  	<td>{$MAIL_DATA.comment.date|date_format:"%d.%m.%Y %H:%M"}</td>
  </tr>
  <tr>
  	<td>{"IP"|translate}</td>
  	<td>{$MAIL_DATA.comment.ip}</td>
  </tr>
  </tbody>
</table>
{"Activate this comment"|translate}:<br/>
<a href="http://{$smarty.server.SERVER_NAME}/index.php?TPL=7600&x7600_comment_id={$MAIL_DATA.comment.id}&x7600_action=activateComment">http://{$smarty.server.SERVER_NAME}/index.php?TPL=7600&x7600_comment_id={$MAIL_DATA.comment.id}&x7600_action=activateComment</a><br/>
{"Delete this comment"|translate}:<br/>
<a href="http://{$smarty.server.SERVER_NAME}/index.php?TPL=7600&x7600_comment_id={$MAIL_DATA.comment.id}&x7600_action=deleteComment">http://{$smarty.server.SERVER_NAME}/index.php?TPL=7600&x7600_comment_id={$MAIL_DATA.comment.id}&x7600_action=deleteComment</a><br/>

</body>
</html>