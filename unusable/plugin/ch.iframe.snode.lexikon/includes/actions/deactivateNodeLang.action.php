<?php

XT::query("UPDATE " . $GLOBALS['plugin']->getTable('nodes') . " SET active = 0 WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND node_id = " . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__);

?>
