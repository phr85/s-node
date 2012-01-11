<?php
XT::call('saveNewsletter');
XT::assign("COPY", false);
XT::assign("CUT", false);
$GLOBALS['plugin']->setAdminModule("e");
?>