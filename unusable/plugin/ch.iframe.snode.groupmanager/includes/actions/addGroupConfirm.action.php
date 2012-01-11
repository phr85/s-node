<?php
// Add a group
$GLOBALS['plugin']->setAdminModule('a');

// Check if group name is empty
if($GLOBALS['plugin']->getValue("title") == ''){
    XT::log("Group name cannot be empty",__FILE__,__LINE__,XT_ERROR);
}

// Check for already existing group name
$result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable('groups') . " WHERE title = '" . $GLOBALS['plugin']->getPostValue('title') . "'",__FILE__,__LINE__);
while($row = $result->FetchRow()){
    XT::log("This group name is already in use",__FILE__,__LINE__,XT_ERROR);
}

// If there were no errors, go ahead an insert group into db
if(!XT::hasErrors()){

    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('groups') . " (
        title,
        description,
        creation_date,
        creation_user,
        mod_date,
        mod_user
        ) VALUES (
        '" . $GLOBALS['plugin']->getPostValue('title') . "',
        '" . $GLOBALS['plugin']->getPostValue('description') . "',
        " . time() . ",
        " . XT::getUserID() . ",
        " . time() . ",
        " . XT::getUserID() . "
        )",__FILE__,__LINE__);

    $GLOBALS['plugin']->setAdminModule('o');
}
?>
