<?php

// Param :: Style
$style = XT::getParam("style") != "" ? XT::getParam("style") : "default.tpl";

$languages = array();

foreach($GLOBALS['cfg']->_languages as $key => $lang) {
    if(strtolower($lang['name']) != "system") {
        $languages[$key] = strtolower($lang['name']);
    }
}

XT::assign('LANGUAGES', $languages);
$content = XT::build($style);

?>