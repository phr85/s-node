<?php
// Get the maxpos
$result = XT::query("
    SELECT
        max(position) as pos
    FROM
        " . $GLOBALS['plugin']->getTable("autopilot_data") . "
    WHERE
        id= " . XT::getSessionValue("slide_id")
    ,__FILE__,__LINE__);
$pos = XT::getQueryData($result);
$position = $pos[0]['pos'] + 1;

XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable("autopilot_data") . "
    (
        id,
        position
    ) VALUES (
        " . XT::getSessionValue("slide_id") . ",
        " . $position . "
    )
    ",__FILE__,__LINE__);

$GLOBALS['plugin']->setAdminModule('e');

?>
