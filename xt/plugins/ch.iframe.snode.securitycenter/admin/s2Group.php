<?php
// execute query and check for errors
$result = XT::query("SELECT id,title,description,active,creation_date,creation_user,mod_date,mod_user FROM " . $GLOBALS['plugin']->getTable("groups") . " WHERE id = " . $GLOBALS['plugin']->getValue("principal_id") . "",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("GROUP", $data[0]);
XT::assign("PRINCIPAL_ID", $GLOBALS['plugin']->getValue("principal_id"));

// Enable Char filter and navigator
XT::enableAdminCharFilter('usr.username');
XT::enableAdminNavigator('users','cnt',"
        SELECT
            count(usr.id) as count_id
        FROM
            " . $GLOBALS['plugin']->getTable("user_groups") . " as grp,
            " . $GLOBALS['plugin']->getTable("users") .  " as usr
        WHERE
            grp.group_id = " . $GLOBALS['plugin']->getValue("principal_id") . "
            AND usr.id = grp.user_id " . XT::getAdminCharFilter('AND') . "
        ");


// Get assigned users
$result = XT::query("
        SELECT
            usr.id,
            usr.username,
            usr.last_login_date,
            usr.active,
            address.firstName,
            address.lastName,
            address.title

        FROM
            " . $GLOBALS['plugin']->getTable("user_groups") . " as grp,
            " . $GLOBALS['plugin']->getTable("users") .  " as usr
        LEFT JOIN " . XT::getTable('addresses') . " as address ON usr.id = address.user_id and address.is_primary_user_address=1
        WHERE
            grp.group_id = " . $data[0]['id'] . "
            AND usr.id = grp.user_id " . XT::getAdminCharFilter('AND') . "
        ORDER
            by usr.username asc
        LIMIT
            " . XT::getAdminNavigatorLimit() . "

        ",__FILE__,__LINE__);

XT::assign("DATA", XT::getQueryData($result));

$content = XT::build("s2Group.tpl");

?>
