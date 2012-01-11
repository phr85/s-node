<?php
// Enable Char filter and navigator
XT::enableAdminCharFilter('name');
XT::enableAdminNavigator('countries','country');

$result = XT::query("
    SELECT
        country,
        name,
        continent
    FROM
        " . $GLOBALS['plugin']->getTable("countries") . XT::getAdminCharFilter() . "
    ORDER BY
            name ASC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("COUNTRIES", $data);

$content = XT::build("countries.tpl");

?>
