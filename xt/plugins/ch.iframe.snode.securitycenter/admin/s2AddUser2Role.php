<?php
if(XT::getPermission('list')){

    // Enable Char filter and navigator
    XT::enableAdminCharFilter('username');
    XT::enableAdminNavigator('users');
    // Get users list

    $result = XT::query("
        SELECT
            ro.id,
            ro.username,
            address.firstName,
            address.lastName,
            ro.active,
            u2r.role_id as checked
        FROM
            " . XT::getTable('users') . " as ro
            LEFT JOIN
            " . XT::getTable('user_roles') . " as u2r  ON
            (u2r.user_id = ro.id  AND u2r.role_id = " . XT::getSessionValue("role_id") . ")
            LEFT JOIN " . XT::getTable('addresses') . " as address ON ro.id = address.user_id and address.is_primary_user_address=1"

    . XT::getAdminCharFilter() . "
        GROUP BY ro.id
        ORDER BY
            ro.username ASC
        LIMIT
            " . XT::getAdminNavigatorLimit() . "
        ",__FILE__,__LINE__,0);

    XT::assign("DATA", XT::getQueryData($result));

    // Build plugin
    $content = XT::build('s2AddUser2Role.tpl');

}

?>
