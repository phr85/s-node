<?php

// Action save Permission
$perms = 0;
if (is_array($GLOBALS['plugin']->getValue('user_perms'))){
foreach($GLOBALS['plugin']->getValue('user_perms') as $key => $value){
    if($value == 1){
        $perms = $GLOBALS['perm']->addPerm($perms, $key);
    }
}
// Delete previously defined permissions
XT::query("DELETE FROM " . $GLOBALS['cfg']->get("database", "prefix") . "perms WHERE base_id = " . $GLOBALS['plugin']->getParam("base_id") . " AND user_id = " . $GLOBALS['plugin']->getSessionValue("perm_user"),__FILE__,__LINE__);
XT::query("INSERT INTO " . $GLOBALS['cfg']->get("database", "prefix") . "perms (perms,base_id,user_id,lang)
 VALUES (" . $perms . "," . $GLOBALS['plugin']->getParam("base_id") . "," . $GLOBALS['plugin']->getSessionValue("perm_user") . ",'" . $GLOBALS['plugin']->getActiveLang() . "')",__FILE__,__LINE__);
 header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id']);
}


XT::assign('ALLOWED', XT::getAllowedFunctions($GLOBALS['plugin']->getParam("base_id")));
XT::assign('DENIED', XT::getDeniedFunctions($GLOBALS['plugin']->getParam("base_id")));

// Enable Char filter and navigator
XT::enableAdminNavigator('','',"SELECT count(id) FROM " . $GLOBALS['cfg']->get("database", "prefix") . "user");

// Get users list
$result = XT::query("
    SELECT
        id,
        username,
        lastName,
        firstName,
        last_login_date,
        active
    FROM
        " . $GLOBALS['cfg']->get("database", "prefix") . "user
    ORDER BY
        username ASC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

XT::assign("USERS", XT::getQueryData($result));

// Check for perm user
if($GLOBALS['plugin']->getValue("perm_user") != ''){
    $GLOBALS['plugin']->setSessionValue("perm_user", $GLOBALS['plugin']->getValue("perm_user"));
}



if(is_numeric($GLOBALS['plugin']->getSessionValue("perm_user"))){

    // Empty perms
    $perms = 0;

    // Set active user
    XT::assign('ACTIVE_USER', $GLOBALS['plugin']->getSessionValue("perm_user"));

    // Get perms for selected user
    $result = XT::query("SELECT perms, base_id FROM " . $GLOBALS['cfg']->get("database", "prefix") . "perms WHERE base_id = " . $GLOBALS['plugin']->getParam("base_id") . " AND user_id = " . $GLOBALS['plugin']->getSessionValue("perm_user") . " LIMIT 1",__FILE__,__LINE__);
    while($row = $result->FetchRow()){
        $perms = $row['perms'];
    }

    $user_perms = array();
    foreach(XT::getPermissions($GLOBALS['plugin']->getParam("base_id")) as $key => $value){
        $user_perms[$value['id']] = XT::getBit($perms, $value['id']);
    }

    // Assign selected user's perms
    XT::assign("USERPERMS", $user_perms);

    XT::addImageButton("Save permissions", "savePermissions", "perms","perms","0","master");
}

XT::assign("PERM_BUTTONS", $GLOBALS['plugin']->getButtons("perms"));

// Build plugin
$content = XT::build('perms.tpl');
?>