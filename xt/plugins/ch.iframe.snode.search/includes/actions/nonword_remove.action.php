<?php
/**
 * Delete/Remove a Nonword
 */
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('search_nonwords') . " WHERE id ='" . $GLOBALS['plugin']->getValue('id') . "'",__FILE__,__LINE__);
XT::log("Nonword has been deleted ",__FILE__,__LINE__,XT_INFO);
$GLOBALS['plugin']->setAdminModule('nw');
?>
