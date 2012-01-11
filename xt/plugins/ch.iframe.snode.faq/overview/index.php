<?php

/**
 * Parameter :: Style (Template)
 */
$style = XT::getParam('style') != '' && XT::styleIsAvailable(XT::getParam('style')) ? XT::getParam('style') : "default.tpl";

if($GLOBALS['plugin']->getValue('article_id') != ''){
   XT::assign('VIEWER', true); 
} else {
   XT::assign('VIEWER', false); 
}

if($GLOBALS['plugin']->getValue('cat_id') != ''){
   XT::assign('CATEGORY', true); 
} else {
   XT::assign('CATEGORY', false); 
}

$content = XT::build($style);

?>