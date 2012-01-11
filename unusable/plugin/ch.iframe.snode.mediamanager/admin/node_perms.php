<?php

/**
 * Get the object (user,group,role) id
 */
if(is_numeric($GLOBALS['plugin']->getValue("perm_id"))){
    $GLOBALS['plugin']->setSessionValue("perm_id", $GLOBALS['plugin']->getValue("perm_id"));
} else {
    if(!is_numeric($GLOBALS['plugin']->getSessionValue("perm_id"))){
        $GLOBALS['plugin']->setSessionValue("perm_id", XT::getUserID());
    }
}
$perm_id = $GLOBALS['plugin']->getSessionValue("perm_id");

/**
 * Get the permission mode (user,group,role)
 */
$perm_mode = $GLOBALS['plugin']->getSessionValue('perm_mode');
if($GLOBALS['plugin']->getValue("perm_mode") != ''){
    $perm_mode = $GLOBALS['plugin']->getValue("perm_mode");
    $GLOBALS['plugin']->setSessionValue('perm_mode', $perm_mode);
}
if($perm_mode == ''){
    $perm_mode = 'user';
    $GLOBALS['plugin']->setSessionValue('perm_mode', $perm_mode);
}

if($GLOBALS['plugin']->getSessionValue('node_id') != ''){

    // Add Buttons
    XT::addButton('Save permissions', 'savePagePermissions');

    // Assign permissions
    XT::assign("PERMS", $GLOBALS['plugin']->getPermissions());

    switch($perm_mode){

        case 'user':
            $perm_object_table = 'user';
            break;

        case 'group':
            $perm_object_table = 'groups';
            break;

        case 'role':
            $perm_object_table = 'roles';
            break;

    }

    // Get perms
    $result = XT::query("
        SELECT
            perms." . $perm_mode . "_id,
            perms.rights
        FROM
            " . $GLOBALS['plugin']->getTable("" . $perm_mode . "_perms") . " as perms,
            " . $GLOBALS['plugin']->getTable($perm_object_table) . " as o
        WHERE
            perms.node_id = " . $GLOBALS['plugin']->getSessionValue('node_id') . "
            AND perms.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
            AND perms." . $perm_mode . "_id = " . $perm_id . "
            AND o.id = perms." . $perm_mode . "_id
    ",__FILE__,__LINE__);

    // Empty data array
    $data = array();

    // Fill data array with user perms for this tpl
    while($row = $result->FetchRow()){
        $data = $row;
    }

    if($data == array()){
        XT::assign("NO_SELECTION", true);
    } else {
        XT::assign("NO_SELECTION", false);
    }

    foreach($GLOBALS['plugin']->getPermissions() as $key => $value){
        if(!in_array($key, $GLOBALS['plugin']->not_single_perms)){
           $rights[$key] = $GLOBALS['perm']->getPerm($data['rights'], $value['id']);
        }
    }
    XT::assign("RIGHTS", $rights);
    XT::assign("NOT_PERMS", $GLOBALS['plugin']->not_single_perms);

    // Assign user tpl perms
    XT::assign("DATA", $data);
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    // Assign actions
    XT::assign("ACTIVE_PERM_ID", $perm_id);
    XT::assign("PERM_MODE", $perm_mode);

    switch($perm_mode){

        case 'user':

            // Enable Char filter and navigator
            XT::enableAdminCharFilter('b.username');
            XT::enableAdminNavigator('user','',"
                SELECT
                    count(b.id)
                FROM
                    " . $GLOBALS['plugin']->getTable("user_perms") . " as a,
                    " . $GLOBALS['plugin']->getTable("user") .  " as b
                WHERE
                    a.node_id = " . $GLOBALS['plugin']->getSessionValue('node_id') . "
                    AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                    AND b.id = a.user_id " . XT::getAdminCharFilter('AND') . "
                ");

            // Get assigned users
            $result = XT::query("
                SELECT
                    b.id,
                    b.username as title,
                    concat(b.lastName,' ',b.firstName) as description
                FROM
                    " . $GLOBALS['plugin']->getTable("user_perms") . " as a,
                    " . $GLOBALS['plugin']->getTable("user") .  " as b
                WHERE
                    a.node_id = " . $GLOBALS['plugin']->getSessionValue('node_id') . "
                    AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                    AND b.id = a.user_id " . XT::getAdminCharFilter('AND') . "
                LIMIT
                    " . XT::getAdminNavigatorLimit() . "
                ",__FILE__,__LINE__);

            XT::assign("USERS", XT::getQueryData($result));
            break;

        case 'group':
            // Enable Char filter and navigator
            XT::enableAdminCharFilter('b.title');
            XT::enableAdminNavigator('','',"
                SELECT
                    count(b.id)
                FROM
                    " . $GLOBALS['plugin']->getTable("group_perms") . " as a,
                    " . $GLOBALS['plugin']->getTable("groups") .  " as b
                WHERE
                    a.node_id = " . $GLOBALS['plugin']->getSessionValue('node_id') . "
                    AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                    AND b.id = a.group_id " . XT::getAdminCharFilter('AND') . "
                ");

            // Get assigned groups
            $result = XT::query("
                SELECT
                    b.id,
                    b.title,
                    b.description
                FROM
                    " . $GLOBALS['plugin']->getTable("group_perms") . " as a,
                    " . $GLOBALS['plugin']->getTable("groups") .  " as b
                WHERE
                    a.node_id = " . $GLOBALS['plugin']->getSessionValue('node_id') . "
                    AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                    AND b.id = a.group_id " . XT::getAdminCharFilter('AND') . "
                LIMIT
                    " . XT::getAdminNavigatorLimit() . "
                ",__FILE__,__LINE__);

            XT::assign("USERS", XT::getQueryData($result));
            break;

        case 'role':
            // Enable Char filter and navigator
            XT::enableAdminCharFilter('b.title');
            XT::enableAdminNavigator('','',"
                SELECT
                    count(b.id)
                FROM
                    " . $GLOBALS['plugin']->getTable("role_perms") . " as a,
                    " . $GLOBALS['plugin']->getTable("roles") .  " as b
                WHERE
                    a.node_id = " . $GLOBALS['plugin']->getSessionValue('node_id') . "
                    AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                    AND b.id = a.role_id " . XT::getAdminCharFilter('AND') . "
                ");

            // Get assigned groups
            $result = XT::query("
                SELECT
                    b.id,
                    b.title,
                    b.description
                FROM
                    " . $GLOBALS['plugin']->getTable("role_perms") . " as a,
                    " . $GLOBALS['plugin']->getTable("roles") .  " as b
                WHERE
                    a.node_id = " . $GLOBALS['plugin']->getSessionValue('node_id') . "
                    AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                    AND b.id = a.role_id " . XT::getAdminCharFilter('AND') . "
                LIMIT
                    " . XT::getAdminNavigatorLimit() . "
                ",__FILE__,__LINE__);

            XT::assign("USERS", XT::getQueryData($result));
            break;
    }
    // Fetch content
    $content = XT::build('node_perms.tpl');
}
?>
