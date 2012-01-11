<?php

// Enable Char filter and navigator
XT::enableAdminCharFilter('name');
XT::enableAdminNavigator('regions','name',
    "SELECT
        count(name)
    FROM
        " . $GLOBALS['plugin']->getTable("regions") . XT::getAdminCharFilter() . "
    "
);

$result = XT::query("
    SELECT
        country,
        region,
        name
    FROM
        " . $GLOBALS['plugin']->getTable("regions") . XT::getAdminCharFilter() . "
    ORDER BY
            name ASC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("REGIONS", $data);

$content = XT::build("regions.tpl");

?>
