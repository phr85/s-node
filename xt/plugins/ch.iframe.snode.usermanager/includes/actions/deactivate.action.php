<?php
/**
 * Deactivates a user
 */
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('user') . " SET active = 0 WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

?>