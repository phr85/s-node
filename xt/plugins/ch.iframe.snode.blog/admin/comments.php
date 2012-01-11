<?php

XT::enableAdminNavigator('comments');

// Get users list
$result = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('comments') . XT::getAdminCharFilter() . "
    ORDER BY
        c_date DESC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

while($row = $result->fetchRow()) {
	$data[] = $row;
}

XT::assign("DATA",$data);
$content = XT::build('comments.tpl');

?>