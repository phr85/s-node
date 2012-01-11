<?php

$GLOBALS['plugin']->addButton('Save', 'addFolderConfirm');
$GLOBALS['plugin']->addButton('Save and add another folder', 'addFolderConfirmAndNew');

/**
 * Assign buttons
 */
$GLOBALS['tpl']->assign("BUTTONS", $GLOBALS['plugin']->getButtons());

/**
 * active folder information
 */
$GLOBALS['tpl']->assign("FOLDER", $GLOBALS['plugin']->getSessionValue("opentitle"));
$GLOBALS['tpl']->assign("FOLDER_ID", $GLOBALS['plugin']->getSessionValue("open"));

$content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'addFolder.tpl');

?>