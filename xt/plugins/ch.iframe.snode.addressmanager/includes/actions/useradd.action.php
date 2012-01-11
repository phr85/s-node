<?php
// Load address entity class
XT::loadClass('address.class.php','ch.iframe.snode.addresses');

$alldata = XT::getValues();

foreach($alldata as $key=>$needed_data) {
	if (in_array($key,XT::getConfig("required_fields"))) {
		if ($needed_data == "") {
			$error[] = "field " . $key . " empty";
		}
	}
}
if (count($error) == 0) {
	// Instantiate address entry
	$address = new XT_Address();
	
	// Update values
	$address->setTitle(XT::getValue('title'));
	$address->setFirstName(XT::getValue('firstName'));
	$address->setLastName(XT::getValue('lastName'));
	$address->setCompany(XT::getValue('company'));
	$address->setPostalCode(XT::getValue('postalCode'));
	$address->setCity(XT::getValue('city'));
	$address->setCountry(XT::getValue("country"));
	$address->setState(XT::getValue("state"));
	$address->setGender(XT::getValue("gender"));
	if($address->getTitle() == ""){
	    $address->generateTitle();
	}
	
	$address->setStreet(XT::getValue('street'));
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
	$address->setSkype(XT::getValue("skype"));
	$address->setPublic(XT::getValue("public"));
	$address->setuserid(XT::getUserid());
	// Commit changes
	$address->save();
	$address->activate();
	XT::assign("ADDED",1);
	
	if (XT::getParam('redirect_tpl') != "") {
		header('Location:index_' . XT::getLang() . '.php?TPL=' . XT::getParam('redirect_tpl'));
	}
} else {
	XT::assign("ERROR",$error);
}
?>