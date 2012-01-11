<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <base href="http://{$smarty.server.SERVER_NAME}/" /> 
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>RE: {$xt1400_MAILCONTENT.title}</title>
</head>
<body>
{print_data array=$xt1400_MAILCONTENT}
<div>
Sehr geehrte(r)  {$xt1400_MAILCONTENT.questioner}
<br /><br />
Sie haben von {$smarty.server.SERVER_NAME} eine Antwort auf Ihre Fragen erhalten.
<br /><br />
Ihre Frage:  {$xt1400_MAILCONTENT.question_title}
{$xt1400_MAILCONTENT.description}
<br /><br />
Antwort von {$xt1400_MAILCONTENT.answer_name}: {$xt1400_MAILCONTENT.answer_title}
{$xt1400_MAILCONTENT.answer}
<br />
-- 
</div>
</body>
</html>