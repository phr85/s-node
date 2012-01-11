<?php
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('user') . " SET active = 1 WHERE id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);
?>