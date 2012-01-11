<?php

// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

// Get areas
$result = XT::query("
    SELECT
        a.id,
        a.title,
        e.firstName,
        e.lastName,
        e.email,
        a.employee_id,
        e.tel,
        e.image
    FROM
        " . XT::getTable('areas') . " as a LEFT JOIN
        " . XT::getTable('employees') . " e ON (e.id = a.employee_id)
    ORDER BY
        a.pos ASC
    ",__FILE__,__LINE__);

$data = XT::getQueryData($result);
XT::assign("AREAS", $data);

$content = XT::build($style);

?>