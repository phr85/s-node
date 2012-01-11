<?php

// Load classes
XT::loadClass('address.class.php','ch.iframe.snode.addressmanager');
XT::loadClass('coordinates.class.php','ch.iframe.snode.addressmanager');

$alldata = XT::getValues();

// Birthdate
if(XT::getValue('birthdate_str')!=""){
    $date_pre = explode(".",XT::getValue('birthdate_str'));
    $birthdate = mktime(0,0,0,$date_pre[1],$date_pre[0],$date_pre[2]);
}else{
    $birthdate = 'NULL';
}

foreach($alldata as $key=>$needed_data) {
	if (in_array($key,XT::getConfig("required_fields"))) {
		if ($needed_data == "") {
			$error[] = "field " . $key . " empty";
		}
	}
}
if (count($error) == 0) {
	// Instantiate address entry
	$address = new XT_Address(XT::getValue('id'));
	
	// Get old E-Mail 
	$oldmail = $address->getEMail();
    
    $email = trim(XT::getValue("email"));
    $email_private = trim(XT::getValue("email_private"));

	// Update values
	$address->setTitle(XT::getValue('title'));
	$address->setFirstName(XT::getValue('firstName'));
	$address->setLastName(XT::getValue('lastName'));
	$address->setCompany(XT::getValue('company'));
	$address->setPostalCode(XT::getValue('postalCode'));
	$address->setCity(XT::getValue('city'));
	$address->setCountry(XT::getValue("country"));
	$address->setGender(XT::getValue("gender"));
	if($address->getTitle() == ""){
	    $address->generateTitle();
	}

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
	$address->setSkype(XT::getValue("skype"));
	$address->setBirthdate($birthdate);
	$address->setPublic(XT::getValue("public"));
	$address->setDescription(XT::getValue("description"));
    
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
	
		// Update system email
		XT::query("
		    UPDATE
		        " . XT::getTable('user') . "
		    SET
		        email = '" . $email . "'
		    WHERE
		        id = '" . XT::getUserid()  . "'
		",__FILE__,__LINE__);
		
		if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.newsletter.zl") && $oldmail != '') {
            // Update email beim newsletter
            XT::query("UPDATE " . XT::getTable('newsletter_subscriptions') . " SET
                email = '" . $email . "'
                WHERE email = '" . $oldmail . "'
            ",__FILE__,__LINE__);
        }
		
	}

	if (XT::getParam('redirect_tpl') != "") {
		header('Location:index_' . XT::getLang() . '.php?TPL=' . XT::getParam('redirect_tpl'));
	}
} else {
	XT::assign("ERROR",$error);
}
?>