<?php

$GLOBALS['plugin']->contribute('addfile_buttons','Upload file', 'uploadFile','import1.png','0','','','');

XT::assign("FOLDER", $GLOBALS['plugin']->getSessionValue("opentitle"));
XT::assign("FOLDER_ID", $GLOBALS['plugin']->getSessionValue("open"));

$content = XT::build('addFile.tpl');

?>