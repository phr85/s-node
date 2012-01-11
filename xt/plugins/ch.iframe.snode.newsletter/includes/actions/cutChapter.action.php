<?php
XT::call('saveNewsletter');
XT::assign("COPY", $GLOBALS['plugin']->getValue('level'));
XT::assign("CUT", true);
$GLOBALS['plugin']->setAdminModule("e");
?>