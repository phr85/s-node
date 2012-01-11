<?php

// Param :: style
$data['metadata']['style'] = XT::autoval("style", "P", "default.tpl");

$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("addresses") ."
    ORDER BY
        RAND()
    LIMIT 1
",__FILE__,__LINE__);

$data['data'] = XT::getQueryData($result);

XT::assign("xt" . XT::getBaseID() . "_random", $data);
$content = XT::build($data['metadata']['style']);

?>