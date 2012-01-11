<?php
// execute query and check for errors
$result = XT::query("SELECT id,title,description,active,creation_date,creation_user,mod_date,mod_user FROM " . $GLOBALS['plugin']->getTable("roles") . " WHERE id = " . $GLOBALS['plugin']->getValue("principal_id") . "",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("ROLE", $data[0]);
XT::assign("PRINCIPAL_ID", $GLOBALS['plugin']->getValue("principal_id"));

// Enable Char filter and navigator
XT::enableAdminCharFilter('usr.username');
XT::enableAdminNavigator('users','cnt',"
        SELECT
            count(usr.id) as count_id
        FROM
            " . $GLOBALS['plugin']->getTable("user_roles") . " as role,
            " . $GLOBALS['plugin']->getTable("users") .  " as usr
        WHERE
            role.role_id = " . $GLOBALS['plugin']->getValue("principal_id") . "
            AND usr.id = role.user_id " . XT::getAdminCharFilter('AND') . "
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
            " . $GLOBALS['plugin']->getTable("user_roles") . " as role,
            " . $GLOBALS['plugin']->getTable("users") .  " as usr
        LEFT JOIN " . XT::getTable('addresses') . " as address ON usr.id = address.user_id and address.is_primary_user_address=1
        WHERE
            role.role_id = " . $data[0]['id'] . "
            AND usr.id = role.user_id " . XT::getAdminCharFilter('AND') . "
        ORDER
            by usr.username asc
        LIMIT
            " . XT::getAdminNavigatorLimit() . "

        ",__FILE__,__LINE__);

XT::assign("DATA", XT::getQueryData($result));

$content = XT::build("s2Role.tpl");

?>
