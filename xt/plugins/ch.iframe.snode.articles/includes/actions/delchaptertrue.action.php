<?php
//Kapitel l�schen
$oChapterAdmin->delete_chapter($var[$PLUGINID]['actionID'], $var[$PLUGINID]['ID']);
$GLOBALS['plugin']->setAdminModule("e");

?>