<?php
if(XT::getPermission('list')){

    // Enable Char filter and navigator
    XT::enableAdminCharFilter('username');
    XT::enableAdminNavigator('users');
    // Get users list

    $result = XT::query("
        SELECT
            grp.id,
            grp.username,
            address.firstName,
            address.lastName,
            grp.active,
            u2r.group_id as checked
        FROM
            " . XT::getTable('users') . " as grp
            LEFT JOIN
            " . XT::getTable('user_groups') . " as u2r  ON
            (u2r.user_id = grp.id  AND u2r.group_id = " . XT::getSessionValue("group_id") . ")
            LEFT JOIN " . XT::getTable('addresses') . " as address ON grp.id = address.user_id and address.is_primary_user_address=1"

    . XT::getAdminCharFilter() . "
        GROUP BY grp.id
        ORDER BY
            grp.username ASC
        LIMIT
            " . XT::getAdminNavigatorLimit() . "
        ",__FILE__,__LINE__);

    XT::assign("DATA", XT::getQueryData($result));

    // Build plugin
    $content = XT::build('s2AddUser2Group.tpl');

}

?>
