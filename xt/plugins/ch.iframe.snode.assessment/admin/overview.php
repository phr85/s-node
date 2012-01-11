<?php

XT::addImageButton("add", "addAssessment" ,"default","add.png","0","slave1","0");

XT::enableAdminNavigator('assessment');

// Get assessment list
$result = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('assessment') .  "
    ORDER BY
        title ASC
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

while($row = $result->fetchRow()) {
	$data['data'][] = $row;
}

XT::assign("xt" . XT::getBaseID() . "_admin",$data);
$content = XT::build('overview.tpl');
?>