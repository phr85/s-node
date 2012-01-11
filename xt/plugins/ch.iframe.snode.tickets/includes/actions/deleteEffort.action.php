<?php
XT::query("
    DELETE FROM " . XT::getTable('tickets_history') . "
 	WHERE 
	id=" . XT::getValue("effort_id"), __FILE__, __LINE__);
XT::setAdminModule('edit');
?>