<?php
XT::query("
    UPDATE xt_addresses
        
    SET
        firstName = '" . $fields['firstname'] . "',
        lastName = '" . $fields['lastname'] . "',
        email = '" . $fields['email'] . "',
        street = '" . $fields['street'] . "',
        city = '" . $fields['city'] . "',
        postalCode = '" . $fields['zip'] . "',
        country = '" . $fields['country'] . "',
        tel = '" . $fields['tel'] . "',
        position = '" . $fields['firma'] . "',
        website= '" . $fields['knr'] . "',
        fax = '" . $fields['fax'] . "'
    WHERE
        user_id = " . $_SESSION["user"]["id"] . "
    ",__FILE__,__LINE__,1);

?>