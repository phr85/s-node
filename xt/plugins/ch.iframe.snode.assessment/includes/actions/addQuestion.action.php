<?php
XT::call('saveAssessment');
XT::setSessionValue("ctrl_add", 1);
// Set the view to edit
XT::setAdminModule("e");
?>