<?php

// Profile name
$fields['pageName']['label'] = $GLOBALS['lang']->msg("Page name");
$fields['pageName']['size'] = 25;
$fields['pageName']['type'] = 'inputtext';
$fields['pageName']['value'] = $GLOBALS['plugin']->getPostValue("pageName");
$fields['pageName']['error'] = @$error['pageName'];

$GLOBALS['tpl']->assign("PROFILE", $fields);

$content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'addPage.tpl');

?>
