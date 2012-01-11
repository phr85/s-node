<?php

// Enable Char filter and navigator
XT::enableAdminCharFilter('title');
XT::enableAdminNavigator('company_locations');

// Add button
XT::addImageButton('Add location','add','default','add.png',0,'slave1');

// Get locations
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable('company_locations') . XT::getAdminCharFilter() . "
    ORDER BY
        title ASC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

XT::assign("DATA", XT::getQueryData($result));

// Build plugin
$content = XT::build('overview.tpl');

?>
