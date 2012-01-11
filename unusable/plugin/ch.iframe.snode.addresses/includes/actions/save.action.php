<?php

XT::setAdminModule('e');

// Load address entity class
XT::loadClass('address.class.php','ch.iframe.snode.addresses');

// Instantiate address entry
$address = new XT_Address(XT::getSessionValue('address_id'));

// Update values
$address->setTitle(XT::getValue('title'));
$address->setType(XT::getValue('type'));
$address->setFirstName(XT::getValue('firstName'));
$address->setLastName(XT::getValue('lastName'));
$address->setPostalCode(XT::getValue('postalCode'));
$address->setCity(XT::getValue('city'));
$address->setCountry(XT::getValue("country"));
$address->setGender(XT::getValue("gender"));
$address->setImage(XT::getValue("image"));
if($address->getTitle() == ""){
    $address->generateTitle();
}
// TODO: Functions needs to be added to address entity class
$address->setOrganization(XT::getValue('organization'));
$address->setOrganizationalUnit(XT::getValue('organizationalUnit'));
$address->setStreet(XT::getValue('street'));
$address->setState(XT::getValue("state"));
$address->setStatus(XT::getValue("status"));
$address->setEMail(XT::getValue("email"));
$address->setEMailPrivate(XT::getValue("email_private"));
$address->setPosition(XT::getValue("position"));
$address->setTelephone(XT::getValue("tel"));
$address->setTelephonePrivate(XT::getValue("tel_private"));
$address->setTelephoneMobile(XT::getValue("tel_mobile"));
$address->setTelephoneMobilePrivate(XT::getValue("tel_mobile_private"));
$address->setFacsimile(XT::getValue("fax"));
$address->setFacsimilePrivate(XT::getValue("fax_private"));
$address->setWebsite(XT::getValue("website"));
$address->setPublic(XT::getValue("public"));

// Commit changes
$address->save();


// timer
$sdate = XT::getValue('sdate');
if($sdate > 0){
    XT::setValue('sdate',mktime(XT::getValue('hstart') ,XT::getValue('mstart'),0,date('m',$sdate),date('d',$sdate),date('y',$sdate)));
}
$edate = XT::getValue('edate');
if ($edate > 0){
    XT::setValue('edate',mktime(XT::getValue('hend') ,XT::getValue('mend'),0,date('m',$edate),date('d',$edate),date('y',$edate)));
}
if(XT::getValue('time_type') == 0){
     XT::setValue('edate',0);
     XT::setValue('sdate',0);
}
XT::query("
    UPDATE
        " . XT::getTable("addresses") . "
    SET
        display_time_type ='" . XT::getValue('time_type') . "',
        display_time_start ='" . XT::getValue('sdate') . "',
        display_time_end ='" . XT::getValue('edate') . "'
 
    WHERE
        id=" . XT::getSessionValue('address_id')
,__FILE__,__LINE__);
?>
