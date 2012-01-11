<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <base href="http://{$smarty.server.SERVER_NAME}/" /> 
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>New Trackback: {$MAIL_DATA.title}</title>
</head>
<body style="text-align: left; font-family: monospace;" >
<table style="text-align: left; width: 50%; font-family: monospace;" border="0" cellpadding="2" cellspacing="2">
  <tbody>
  <tr>
  	<td>{"Blog name"|translate}</td>
  	<td>{$MAIL_DATA.blog_name}</td>
  </tr>
  <tr>
  	<td>{"Blog Url"|translate}</td>
  	<td>{$MAIL_DATA.url}</td>
  </tr>
  <tr>
  	<td>{"Title"|translate}</td>
  	<td>{$MAIL_DATA.title}</td>
  </tr>
  <tr>
  	<td>{"Excerpt"|translate}</td>
  	<td>{$MAIL_DATA.excerpt}</td>
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
<br/>
<a href="http://{$smarty.server.SERVER_NAME}/index.php?TPL=7600&x7600_trackback_id={$MAIL_DATA.id}&x7600_action=activateTrackback">Activate this trackback</a><br/>
<br/><br/>
<a href="http://{$smarty.server.SERVER_NAME}/index.php?TPL=7600&x7600_trackback_id={$MAIL_DATA.id}&x7600_action=deactivateTrackback">Deactivate this trackback</a><br/>
<br/><br/>
<a href="http://{$smarty.server.SERVER_NAME}/index.php?TPL=7600&x7600_trackback_id={$MAIL_DATA.id}&x7600_action=deleteTrackback">Delete this trackback</a><br/>

</body>
</html>