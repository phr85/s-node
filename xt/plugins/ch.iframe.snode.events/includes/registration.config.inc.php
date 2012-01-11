<?php

// Confirmation Email goes to: 1 for contact, 2 for eventaddress, 3 for other address)
$registerconfig['receivers'][] = 1;
//$registerconfig['receivers'][] = 2;
//$registerconfig['receivers'][] = "dzogg@iframe.ch";

// Adresstyp
$registerconfig['usertype'] = 3;

// tocheck
XT::addConfig("tocheck", array(
    "empty" => array(
        "firstName" => "No firstname given",
        "lastName" => "No lastname given",
        "street" => "No street given",
        "street_nr" => "No nummer given",
        "postalCode" => "No zip given",
        "city" => "No city given",
        "email" => "No email given",
        "tel" => "No tel given",
    ),
    "callback" => array(
        "email" => array(
            "function" => array(
                "XT",
                "checkEmail"
            ),
            "message" => "No valid email given",
        ),
    ),
));

?>