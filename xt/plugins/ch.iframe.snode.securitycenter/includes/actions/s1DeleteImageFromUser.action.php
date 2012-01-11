<?php
 XT::query("UPDATE " . $GLOBALS['plugin']->getTable('users') . " SET
        image = 0
    WHERE id = " . $GLOBALS['plugin']->getValue('user_id'),__FILE__,__LINE__);
?>