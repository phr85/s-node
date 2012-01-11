<?php

if(is_numeric($GLOBALS['plugin']->getValue("id"))){
    $GLOBALS['plugin']->setSessionValue('id', $GLOBALS['plugin']->getValue("id"));
}

if($GLOBALS['plugin']->getSessionValue('id') && XT::getPermission('edit')){

    // execute query and check for errors
    $result = XT::query("
        SELECT
            id,
            title,
            description,
            active,
            creation_date,
            creation_user,
            mod_date,
            mod_user
        FROM
            " . $GLOBALS['plugin']->getTable("groups") . "
        WHERE
            id = " . $GLOBALS['plugin']->getSessionValue("id") . "
        ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        $data[] = $row;
    }

    XT::assign("GROUP", $data[0]);

    // Enable Char filter and navigator
    XT::enableAdminCharFilter('b.username');
    XT::enableAdminNavigator('user','',"
        SELECT
            count(b.id)
        FROM
            " . $GLOBALS['plugin']->getTable("user_groups") . " as a,
            " . $GLOBALS['plugin']->getTable("user") .  " as b
        WHERE
            a.group_id = " . $data[0]['id'] . "
            AND b.id = a.user_id " . XT::getAdminCharFilter('AND') . "
        ");

    // Get assigned users
    $result = XT::query("
        SELECT
            b.id,
            b.username,
            b.lastName,
            b.firstName,
            b.last_login_date,
            b.active
        FROM
            " . $GLOBALS['plugin']->getTable("user_groups") . " as a,
            " . $GLOBALS['plugin']->getTable("user") .  " as b
        WHERE
            a.group_id = " . $data[0]['id'] . "
            AND b.id = a.user_id " . XT::getAdminCharFilter('AND') . "
        LIMIT
            " . XT::getAdminNavigatorLimit() . "
        ",__FILE__,__LINE__);

    XT::assign("DATA", XT::getQueryData($result));

    $content = XT::build('edit.tpl');
} else {
    XT::log("No User ID set.",__FILE__,__LINE__,XT_ERROR);
}
?>
