<?php

// Username
$fields['username']['label'] = $GLOBALS['lang']->msg("Username");
$fields['username']['size'] = 25;
$fields['username']['type'] = 'inputtext';
$fields['username']['value'] = $GLOBALS['plugin']->getPostValue("username");
//$fields['username']['error'] = @$error['username'];

// Password
$fields['password']['label'] = $GLOBALS['lang']->msg("Password");
$fields['password']['type'] = 'inputpassword';
$fields['password']['size'] = 25;
//$fields['password']['error'] = @$error['password'];

// Confirm password
$fields['password_confirm']['label'] = $GLOBALS['lang']->msg("Confirm password");
$fields['password_confirm']['type'] = 'inputpassword';
$fields['password_confirm']['size'] = 25;
//$fields['password_confirm']['error'] = @$error['password_confirm'];

// E-Mail
$fields['email']['label'] = $GLOBALS['lang']->msg("E-Mail");
$fields['email']['size'] = 25;
$fields['email']['value'] = $GLOBALS['plugin']->getPostValue("email");
$fields['email']['type'] = 'inputtext';
//$fields['email']['error'] = @$error['email'];

$GLOBALS['tpl']->assign("USER", $fields);

$content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'add.tpl');

?>
