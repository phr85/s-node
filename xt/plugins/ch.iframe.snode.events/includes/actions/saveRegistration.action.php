<?php
XT::query("
    UPDATE
        " . XT::getTable("addresses") . "
    SET
        firstName = '" . XT::getValue("firstName")  . "',
        lastName = '" . XT::getValue("lastName") . "',
        street = '" . XT::getValue("street") . "',
        postalCode = '" . XT::getValue("postalCode") . "',
        city = '" . XT::getValue("city") . "',
        email = '" . XT::getValue("email") . "',
        tel = '" . XT::getValue("tel") . "'
    WHERE
        id = '" . XT::getSessionValue("address_id") . "'
", __FILE__,__LINE__);

$field = XT::getValue("field");
if (is_array($field)) {
	
    foreach ($field as $id => $value) {
    	XT::query("
    	   UPDATE 
    	       " . XT::getTable("events_registrations_details") . "
           SET
                fieldvalue = '" . $value . "' 
           WHERE
                id = '" . $id  . "'
    	",__FILE__,__LINE__);
    }
}
?>