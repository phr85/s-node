<?php
XT::query("
    UPDATE
        " . XT::getTable("autopilot_data") . "
    SET
        active = 0
    WHERE
        id = " . XT::getValue("slide_id") . "
    AND
        position = " . XT::getValue("position") . "
",__FILE__,__LINE__);

?>