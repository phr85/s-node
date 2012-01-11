<?php

// Parameter :: Title
$title = $GLOBALS['plugin']->getParam('title') != '' ? $GLOBALS['plugin']->getParam('title') : '';

// Parameter :: master
$master = $GLOBALS['plugin']->getParam('master') != '' ? $GLOBALS['plugin']->getParam('master') : '';

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

XT::assign("xt" . XT::getBaseID() . "_slave",$GLOBALS['slaves'][$master]['DATA']);

// build content
$content = XT::build($style);

XT::clear_assign("xt" . XT::getBaseID() . "_slave");

?>