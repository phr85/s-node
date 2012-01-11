<?php
if(XT::getPermission('list')){

    // Enable Char filter and navigator
    XT::enableAdminCharFilter('username');
    XT::enableAdminNavigator('users');
    // Get users list

    $result = XT::query("
        SELECT
            usr.id,
            usr.username,
            usr.active,
            address.firstName,
            address.lastName,
            spr.principal_type
        FROM
            " . XT::getTable('users') . " as usr
            LEFT JOIN
            " . XT::getTable('pools_rel') . " as spr  ON
            (spr.principal_id = usr.id AND spr.principal_type=1 AND spr.node_id=" . $GLOBALS['plugin']->getSessionValue('open') . ")
            LEFT JOIN " . XT::getTable('addresses') . " as address ON usr.id = address.user_id and address.is_primary_user_address=1"
    . XT::getAdminCharFilter() . "
        GROUP BY
            usr.id
        ORDER BY
            usr.username ASC
        LIMIT
            " . XT::getAdminNavigatorLimit() . "
        ",__FILE__,__LINE__);

    XT::assign("DATA", XT::getQueryData($result));

    // Build plugin
    $content = XT::build('users.tpl');

}

?>
