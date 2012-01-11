<?php

$key = XT::getConfig('googleMapsKey');

// Parameter: Captcha enabled?
$data['captcha'] = $captcha;

// Read input
$name = strip_tags(XT::getValue('name'));
$date = XT::autoVal('datearray',"S");
$title = strip_tags(XT::getValue('title'));
$email = trim(strip_tags(XT::getValue('email')));

// Description
$description = strip_tags(XT::getValue('description'));
XT::setValue('description',$description);
$inputvalues['description'] = $description;

// GMAP
$city = strip_tags(XT::getValue('city'));
$housenumber = strip_tags(XT::getValue('housenumber'));
$street = strip_tags(XT::getValue('street'));

//Get Google Maps coordinates if not empty
if ($city != "" and $street != ""){
	//Get Coordinates from the given address
	$adresse="http://maps.google.com/maps/geo?q=$housenumber+$street+$city&output=xml&key=$key"; 
	
	//Get Google's XML File
	$urlinhalt=file_get_contents($adresse); 
	
	//Convert file to utf8
	$urlinhalt = utf8_decode($urlinhalt); 
	
	//Create Simple XML Element
	$xml = new SimpleXMLElement($urlinhalt); 
	
	//Read coordinates and save them to 3 variables
	list($longitude, $latitude, $altitude) = explode(",",$xml->Response->Placemark->Point->coordinates);
		
	if($latitude == "" OR $longitude == ""){
		$addressnotfound = true;
		XT::setValue('adressnotfound',XT::translate("Sorry. Address not found"));
		$inputvalues['adressnotfound'] = XT::translate("Sorry. Address not found");
	}else{
		$inputvalues['longitude'] = $longitude;
		$inputvalues['latitude'] = $latitude;
		XT::setValue('street',$street);
		$inputvalues['street'] = $street;
		XT::setValue('city',$city);
		$inputvalues['city'] = $city;
		XT::setValue('housenumber',$housenumber);
		$inputvalues['housenumber'] = $housenumber;
	}
	$inputvalues['addressnotgiven'] = true;
}


// check if date selection is not empty
if (!empty($date)){
	$forgotdate = false;
	XT::setValue('date',$date);
	XT::setValue('selected_dates',serialize($date));
	$inputvalues['date'] = $date;
}else{
	$forgotdate = true;
	$errors['date'] = XT::translate('No date selected');
}

if (XT::getValue('visibility') == "true"){
	$visibility = true;
	XT::setValue('visibility',$visibility);
	$inputvalues['visibility'] == true;
};

// check if name is not empty
if ($name !=""){
	$forgotname = false;
	XT::setValue('name',$name);
	$inputvalues['name'] = $name;
}else{
	$forgotname = true;
	$errors['name'] = XT::translate('No name entered');
}

// Is there any information in the title input?
if ($title !=""){
	$forgottitle = false;
	XT::setValue('title',$title);
	$inputvalues['title'] = $title;
}else{
	$forgottitle = true;
	$errors['title'] = XT::translate('No title');
}

// Check if Email is empty
if ($email !=""){
	$forgotemail = false;
	$inputvalues['email'] = $email;
	// If is not empty, check if correct
	if (!XT::checkEmail($email)) {
		$errors['email'] = XT::translate('Email not valid');
	}else{
		XT::setValue('email',$email);
	}
}else{
	$forgotemail = true;
	$errors['email'] = XT::translate('No Email');
}

// If something was empty / wrong
if ($forgotname == true OR $forgotdescription == true OR $forgotemail == true OR $forgotdate == true){
	$errors['main'] = XT::translate('Please check your input data');
}else{
	if ($captcha == false) {
		// Go to next step
		XT::setValue('step','times');
	} else {
		// If Captcha is enabled
		if ($_SESSION['captcha_faq'] == md5(strtoupper($_REQUEST['captcha_faq']))) {
			XT::setValue('step','times');
			include('times.php');
			// Entered captcha not correct -> assign errors
		} else {
			$errors['captcha'] = XT::translate('Captcha incorrect');
		}
	}
}

// Set possible errors.
XT::setValue('errors',$errors);
XT::setSessionValue('inputvalues',$inputvalues);
XT::setValue('inputvalues',$inputvalues);

XT::assign("xt" . XT::getBaseID() . "_add", $data);
$content = XT::build($style."/start.tpl");

?>