<?php

if($GLOBALS['plugin']->getSessionValue('id') != ''){

    $GLOBALS['tpl']->assign("LABEL_SUBMIT", $GLOBALS['lang']->msg("Add this user"));
    $GLOBALS['tpl']->assign("LABEL_CHOOSEUSER", $GLOBALS['lang']->msg("Choose user to add"));
    $GLOBALS['tpl']->assign("LABEL_USERNAME", $GLOBALS['lang']->msg("Username"));

    $content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'addUserPerms.tpl');
}

?>