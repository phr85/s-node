<?php
// Save role data
// Check if role name is empty
if($GLOBALS['plugin']->getValue("title") == ''){
    XT::log("Role name cannot be empty",__FILE__,__LINE__,XT_ERROR);
}

if(!XT::hasErrors()){
    XT::query("UPDATE " . $GLOBALS['plugin']->getTable('roles') . " SET
        title = '" . $GLOBALS['plugin']->getPostValue('title') . "'
        , description = '" . $GLOBALS['plugin']->getPostValue('description') . "'
        WHERE id = " . $GLOBALS['plugin']->getValue('role_id')
    ,__FILE__,__LINE__);
}
?>
