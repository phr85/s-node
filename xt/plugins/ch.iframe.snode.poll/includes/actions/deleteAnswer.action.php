<?php

XT::call("savePoll");

XT::query("DELETE FROM " . XT::getTable("answers") . " WHERE id = " . XT::getValue("answer_id") . "",__FILE__,__LINE__);

XT::query("SELECT * FROM " . XT::getTable("answers") . " WHERE id = " . XT::getValue("answer_id") . " ORDER BY position",__FILE__,__LINE__);

XT::call("reOrderPositions");

XT::setAdminModule("edit");

?>