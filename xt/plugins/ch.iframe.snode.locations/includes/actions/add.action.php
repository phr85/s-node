<?php

// Add location
XT::query("
    INSERT INTO
        " . XT::getTable("company_locations") . "
    (
        creation_date,
        creation_user,
        country
    ) VALUES (
        " . time() . ",
        " . XT::getUserID() . ",
        'CH'
    )
",__FILE__,__LINE__);

// Get the new id
$result = XT::query("
    SELECT
        id
    FROM
        " . XT::getTable("company_locations") . "
    ORDER BY
        id DESC
    LIMIT 1
",__FILE__,__LINE__);

$data = XT::getQueryData($result);

// Set the new id
XT::setValue("location_id",$data[0]['id']);

// Move to edit mode
XT::setAdminModule('e');

?>
