<?php
// Eventmanager registrierung


// Create Address
XT::loadClass('address.class.php','ch.iframe.snode.addressmanager');

// Instantiate address entry
$address = new XT_Address();
// Update values
$address->setTitle($fields['firstName'] . ' ' . $fields['lastName']);
$address->setFirstName($fields['firstName']);
$address->setLastName($fields['lastName']);
$address->setEMail($fields['email']);
$address->setPostalCode($fields['postalCode']);
$address->setCity($fields['city']);
$address->setStreet($fields['street']);
$address->setTelephone($fields['tel']);
$address->setType(3);
// Commit changes
$address->save();


/**
* Get id of new entry
*/

$address_id = $address->getID();

/**
* Create relation to event
*/
XT::query("
        INSERT INTO
            xt_events_registrations
            (
                event_id,
                address_id
            ) VALUES
            (
                " . $fields['event_id'] . ",
                " . $address_id . "
            )
    ",__FILE__,__LINE__);

/**
* Fill details table
*/
foreach ($fields as $key=>$value) {
    if ($key != "city"  || $key != "street"  || $key != "tel"  || $key != "event_id" || trim($key) != "") {

        if (is_array($value)) {
            foreach ($value as $arr_vals) {
                XT::query("
            		  INSERT INTO
            		      xt_events_registrations_details
            		      (
            		          event_id,
            		          address_id,
            		          fieldname,
            		          fieldvalue
        		          ) VALUES (
        		              ". $fields['event_id'] . ",
        		              ". $address_id . ",
        		              '" . $key . "',
        		              '" . $arr_vals . "'
        		              )
            		",__FILE__,__LINE__);
            }
        }
        else {
            XT::query("
        		  INSERT INTO
        		      xt_events_registrations_details
        		      (
        		          event_id,
        		          address_id,
        		          fieldname,
        		          fieldvalue
    		          ) VALUES (
    		              " . $fields['event_id'] . ",
    		              " . $address_id . ",
    		              '" . $key . "',
    		              '" . $value . "'
    		              )
        		",__FILE__,__LINE__);
        }
    }
}
// count user
XT::query("update xt_events set `reg_visitors`=reg_visitors+1
where `id`='" . $fields['event_id'] . "'",__FILE__,__LINE__);

?>