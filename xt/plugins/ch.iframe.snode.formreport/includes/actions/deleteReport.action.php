<?php

// Delete report
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('formreport') . " WHERE  id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('formreport_tree_rel') . " WHERE report_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

?>