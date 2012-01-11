<?php
XT::query("UPDATE " . XT::getTable('assessment') . " 
	SET
	mod_user=" . XT::getUserID() . ",
	mod_date=" . time() . ",
	active=1
	WHERE id=" . XT::getValue("id")  . "
	",__FILE__,__LINE__);
?>