<?php
XT::query("DELETE FROM " . XT::getTable('relations') . " WHERE id=" . XT::getValue('id') ,__FILE__,__LINE__);
XT::call('cleanupPositions');
?>