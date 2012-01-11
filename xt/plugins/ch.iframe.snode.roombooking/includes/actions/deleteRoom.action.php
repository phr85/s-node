<?php
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("rbs_rooms") . " WHERE id = " . $GLOBALS['plugin']->getValue("room_id") . "",__FILE__,__LINE__);
?>
