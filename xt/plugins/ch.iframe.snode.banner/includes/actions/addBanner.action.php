<?php
XT::call('saveZone');
XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("banner") . "
    (
        creation_date,
        creation_user
    ) VALUES (
        " . time() . ",
        " . XT::getUserID() . "
    )
",__FILE__,__LINE__);

// Get the new id
$result = XT::query("
    SELECT
        id
    FROM
        " . $GLOBALS['plugin']->getTable("banner") . "
    ORDER BY
        id DESC
    LIMIT 1
",__FILE__,__LINE__);

$data = XT::getQueryData($result);

if($GLOBALS['plugin']->getValue("zone_id") > 0){
    XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("banner_zones_rel") . "
    (
        zone_id,
        banner_id
    ) VALUES (
        " . $GLOBALS['plugin']->getValue("zone_id") . ",
        " . $data[0]['id'] . "
    )
",__FILE__,__LINE__);
}

// Set the new id
$GLOBALS['plugin']->setValue("banner_id",$data[0]['id']);

$GLOBALS['plugin']->setAdminModule('eb');

?>
