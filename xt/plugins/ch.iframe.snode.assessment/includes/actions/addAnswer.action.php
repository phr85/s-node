<?php
XT::call('saveQuestion');
XT::setSessionValue("ctrl_add_answer", 1);
// Set the view to edit
XT::setAdminModule("eq");
?>
