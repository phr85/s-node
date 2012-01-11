<?php
// execute query and check for errors
$result = XT::query("SELECT node_id as id,title
FROM " . $GLOBALS['plugin']->getTable("pools_details") . "
WHERE node_id = " . $GLOBALS['plugin']->getSessionValue("open") . "",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("POOL", $data[0]);
XT::assign("PRINCIPAL_ID", $GLOBALS['plugin']->getValue("principal_id"));

// Enable Char filter and navigator
XT::enableAdminCharFilter('usr.username');
XT::enableAdminNavigator('users','cnt',"
        SELECT
            count(usr.id) as count_id
        FROM
            " . $GLOBALS['plugin']->getTable("pools_rel") . " as spr,
            " . $GLOBALS['plugin']->getTable("users") .  " as usr
        WHERE
            spr.principal_type=1 AND
            spr.node_id=" . $GLOBALS['plugin']->getSessionValue('open') . "
            AND usr.id = spr.principal_id " . XT::getAdminCharFilter('AND') . "
        ");

$result = XT::query("
        SELECT
            usr.id,
            usr.username,
            usr.active,
            address.firstName,
            address.lastName,
            address.title

        FROM " . XT::getTable('pools_rel') . " as spr
        INNER JOIN " . XT::getTable('users') . " as usr ON spr.principal_id = usr.id
	    LEFT JOIN " . XT::getTable('addresses') . " as address ON usr.id = address.user_id and address.is_primary_user_address=1
        WHERE
            spr.principal_type=1
            AND spr.node_id=" . $GLOBALS['plugin']->getSessionValue('open') . "

            ". XT::getAdminCharFilter('AND') . "
        GROUP
            by usr.id
        ORDER
            by usr.username asc
        LIMIT
            " . XT::getAdminNavigatorLimit() . "

        ",__FILE__,__LINE__);


XT::assign("DATA", XT::getQueryData($result));

$content = XT::build("s2Pool.tpl");

?>