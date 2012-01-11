<?php
// Save the status
XT::setValue("status",1);


$result = XT::query("
	    SELECT
	       *
	    FROM
	        " . XT::getTable('tickets') . "
	    WHERE
			id=" . XT::getValue('id') . "
	",__FILE__,__LINE__);
	$row = $result->fetchRow();
	if ($row['supervisor'] == 0) {
		XT::query("
    UPDATE
        " . XT::getTable('tickets') . "
  	SET supervisor=" . XT::getUserId() . " WHERE id=" . XT::getValue('id') . "
", __FILE__, __LINE__);
	}
XT::query("
    UPDATE
        " . XT::getTable('tickets') . "
  	SET worker=" . XT::getUserId() . " WHERE id=" . XT::getValue('id') . "
", __FILE__, __LINE__);
XT::call("statusChange");
XT::log(XT::translate('Ticket taken'),__FILE__,__LINE__,XT_INFO);
XT::setAdminModule('edit');
?>