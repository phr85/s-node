<?php

XT::enableAdminNavigator('comments_trackback_incomming');

// Get users list
$result = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('comments_trackback_incomming') . XT::getAdminCharFilter() . "
    ORDER BY
        date DESC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

while($row = $result->fetchRow()) {
	$data[] = $row;
}

XT::assign("DATA",$data);
$content = XT::build('trackbacks.tpl');

?>