<?php

if(is_numeric($GLOBALS['plugin']->getValue("node_id"))){
    $GLOBALS['plugin']->setSessionValue("node_id",$GLOBALS['plugin']->getValue("node_id"));
}

if(is_numeric($GLOBALS['plugin']->getValue("base_id"))){
    $GLOBALS['plugin']->setSessionValue("base_id",$GLOBALS['plugin']->getValue("base_id"));
}

if(is_string($GLOBALS['plugin']->getValue("lang_filter"))){
    $GLOBALS['plugin']->setSessionValue("lang_filter",$GLOBALS['plugin']->getValue("lang_filter"));
}
if(is_string($GLOBALS['plugin']->getValue("package"))){
    $GLOBALS['plugin']->setSessionValue("package",$GLOBALS['plugin']->getValue("package"));
}

?>