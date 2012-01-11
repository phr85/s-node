<?php

XT::query("UPDATE " . XT::getTable('nodes') . " SET active = 1 WHERE lang = '" . $GLOBALS['plugin']->getActiveLang() . "' AND node_id = " . XT::getValue('id'),__FILE__,__LINE__);

?>
