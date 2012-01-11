<?php
// Insert an empty assessment
$now = time();
XT::query("INSERT INTO " . XT::getTable('assessment') . " (creation_date,creation_user, active,title) VALUES (" . $now . "," . XT::getUserID() . ",0,'" . XT::translate("New assessment") . "')",__FILE__,__LINE__);

// Get the newest id
$result_assessment = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('assessment') .  "
    WHERE
	creation_date=" . $now . "
    ",__FILE__,__LINE__);
$row_assessment = $result_assessment->fetchRow();
XT::setValue("id",$row_assessment['id']);

// Set the view to edit
XT::setAdminModule("e");
?>