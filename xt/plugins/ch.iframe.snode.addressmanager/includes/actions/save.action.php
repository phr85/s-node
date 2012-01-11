<?php

XT::setAdminModule('e');

// Load classes
XT::loadClass('address.class.php','ch.iframe.snode.addressmanager');
XT::loadClass('coordinates.class.php','ch.iframe.snode.addressmanager');

if(XT::getValue('birthdate_str')!=""){
    $date_pre = explode(".",XT::getValue('birthdate_str'));
    $birthdate = mktime(0,0,0,$date_pre[1],$date_pre[0],$date_pre[2]);
}else{
    $birthdate = 'NULL';
}


if(XT::getValue('sdate_str')!=""){
    $sdate_pre = explode(".",XT::getValue('sdate_str'));
    $sdate = mktime(0,0,0,$sdate_pre[1],$sdate_pre[0],$sdate_pre[2]);
}else{
    $sdate = 'NULL';
}
if($sdate > 0){
    XT::setValue('sdate',mktime(XT::getValue('hstart') ,XT::getValue('mstart'),0,date('m',$sdate),date('d',$sdate),date('y',$sdate)));
}

if(XT::getValue('edate_str')!=""){
    $edate_pre = explode(".",XT::getValue('edate_str'));
    $edate = mktime(0,0,0,$edate_pre[1],$edate_pre[0],$edate_pre[2]);
}else{
    $edate = 'NULL';
}
if ($edate > 0){
    XT::setValue('edate',mktime(XT::getValue('hend') ,XT::getValue('mend'),0,date('m',$edate),date('d',$edate),date('y',$edate)));
}

// Instantiate address entry
$address = new XT_Address(XT::getValue('id'));

// Get old E-Mail
$oldmail = trim($address->getEmail());

$email = trim(XT::getValue("email"));
$email_private = trim(XT::getValue("email_private"));

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
$address->setCompany(XT::getValue('company'));
$address->setStreet(XT::getValue('street'));
$address->setState(XT::getValue("state"));
$address->setStatus(XT::getValue("status"));
$address->setEMail($email);
$address->setEMailPrivate($email_private);
$address->setPosition(XT::getValue("position"));
$address->setTelephone(XT::getValue("tel"));
$address->setTelephonePrivate(XT::getValue("tel_private"));
$address->setTelephoneMobile(XT::getValue("tel_mobile"));
$address->setTelephoneMobilePrivate(XT::getValue("tel_mobile_private"));
$address->setFacsimile(XT::getValue("fax"));
$address->setFacsimilePrivate(XT::getValue("fax_private"));
$address->setWebsite(XT::getValue("website"));
$address->setPublic(XT::getValue("public"));
$address->setDescription(XT::getValue("description"));
$address->setSkype(XT::getValue("skype"));
$address->setBirthdate($birthdate);
$address->setDisplay_time_type(XT::getValue('time_type'));
$address->setDisplay_time_start(XT::getValue('sdate'));
$address->setDisplay_time_end(XT::getValue('edate'));

// Get coordinates
if($GLOBALS['cfg']->get("system","google_map_key") != "" &&
   XT::getValue('street') != "" &&
   XT::getValue('postalCode') != "" &&
   XT::getValue('city') != "" &&
   XT::getValue('country') != "") {
    
    $coordinates = new coordinates($GLOBALS['cfg']->get("system","google_map_key"));
    $coordinates->set("street",XT::getValue('street'));
    $coordinates->set("postal_code",XT::getValue('postalCode'));
    $coordinates->set("city",XT::getValue('city'));
    $coordinates->set("country", XT::getValue('country'));
    
    if($coordinates_array = $coordinates->query()) {
        $address->setLatitude($coordinates_array['lat']);
        $address->setLongitude($coordinates_array['lon']);
    }
}

// Commit changes
$address->save();

if($address->getPrimaryUserAddress() && XT::checkEmail($email)){

    if($address->getuserid() != '') {

        // Update email beim User
        XT::query("UPDATE " . XT::getTable('user') . " SET
            email = '" . $email . "',
            image = '" . XT::getValue("image") . "'
            WHERE id = " . $address->getuserid()
        ,__FILE__,__LINE__);

    }

    if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.newsletter.zl") && $oldmail != '') {

        // Update email beim newsletter
        XT::query("UPDATE " . XT::getTable('newsletter_subscriptions') . " SET
            email = '" . $email . "'
            WHERE email = '" . $oldmail . "'
        ",__FILE__,__LINE__);

    }
}

?>
