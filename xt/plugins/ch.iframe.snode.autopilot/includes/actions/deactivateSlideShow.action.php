<?php
XT::query("
    UPDATE
        " . XT::getTable("autopilot") . "
    SET
        active = 0
    WHERE id = " . XT::getValue("slide_id") . "
",__FILE__,__LINE__);

?>