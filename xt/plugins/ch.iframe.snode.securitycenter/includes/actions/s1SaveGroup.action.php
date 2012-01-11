<?php
// Save group data
// Check if group name is empty
if($GLOBALS['plugin']->getValue("title") == ''){
    XT::log("Group name cannot be empty",__FILE__,__LINE__,XT_ERROR);
}

if(!XT::hasErrors()){
    XT::query("UPDATE " . $GLOBALS['plugin']->getTable('groups') . " SET
        title = '" . $GLOBALS['plugin']->getPostValue('title') . "'
        , description = '" . $GLOBALS['plugin']->getPostValue('description') . "'
        WHERE id = " . $GLOBALS['plugin']->getValue('group_id'),__FILE__,__LINE__);
}
?>
