<?php
if(XT::getPermission('list')){
    // Enable Char filter and navigator
    XT::enableAdminCharFilter('title');
    XT::enableAdminNavigator('groups');

    // Get users list
    $result = XT::query("
        SELECT
            ro.id,
            ro.title,
            ro.description,
            ro.active,
            g2r.role_id as checked
        FROM
            " . XT::getTable('groups') . " as ro
            LEFT JOIN
            " . XT::getTable('group_roles') . " as g2r  ON
            (g2r.group_id = ro.id  AND g2r.role_id = " . $GLOBALS['plugin']->getSessionValue("role_id") . ")"

    . XT::getAdminCharFilter() . "
        ORDER BY
            ro.title ASC
        LIMIT
            " . XT::getAdminNavigatorLimit() . "
        ",__FILE__,__LINE__);

    XT::assign("DATA", XT::getQueryData($result));

    // Build plugin
    $content = XT::build('s2AddGroup2Role.tpl');

}

?>
