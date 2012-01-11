<?php

// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: Address ID
$id = XT::getParam('id') != '' ? XT::getParam('id') : '0';
if(XT::getValue('id') > 0){
$id = XT::getValue('id') ;
}


// Get address details
$result = XT::query("
    SELECT
        a1.*,
        a2.id as org_id,
        a2.title as org_title,
        a2.type as org_type,
        a2.email as org_email,
        a2.postalCode as org_postalCode,
        a2.city as org_city,
        a2.street as org_street,
        a2.state as org_state,
        a2.country as org_country,
        a2.status as org_status,
        a2.tel as org_tel,
        a2.fax as org_fax,
        a2.website as org_website,
        a2.image as org_image,
        a3.id as dep_id,
        a3.title as dep_title,
        a3.type as dep_type,
        a3.email as dep_email,
        a3.postalCode as dep_postalCode,
        a3.city as dep_city,
        a3.street as dep_street,
        a3.state as dep_state,
        a3.country as dep_country,
        a3.status as dep_status,
        a3.tel as dep_tel,
        a3.fax as dep_fax,
        a3.website as dep_website,
        a3.image as dep_image
    FROM
        " . XT::getDatabasePrefix() . "addresses as a1
    LEFT JOIN 
        " . XT::getDatabasePrefix() . "addresses as a2 ON (a1.organization = a2.id)
    LEFT JOIN 
        " . XT::getDatabasePrefix() . "addresses as a3 ON (a1.organizationalUnit = a3.id)
    WHERE
        a1.id IN (" . $id . ") 
    AND
        (a1.display_time_start = 0 OR a1.display_time_start < " . time() . ")
    AND
        (a1.display_time_end = 0 OR a1.display_time_end > " . time() . ")"
,__FILE__,__LINE__);

$addresses = array();
while($row = $result->FetchRow()){
    $addresses[] = $row;
}

if(sizeof($addresses) > 1){
    XT::assign("ADDRESSES",$addresses);
} else {
    XT::assign("ADDRESS", $addresses[0]);
}

$content = XT::build($style);

?>