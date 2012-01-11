<?php

$uid = XT::getValue("principal_id");
$result = XT::query("
	SELECT *
	FROM
	" . XT::getTable("users") . "
	WHERE
	id=" . $uid . "
	",__FILE__,__LINE__,0);
	if($row = $result->FetchRow()){
		XT::loadClass('address.class.php','ch.iframe.snode.addressmanager');

		// Instantiate address entry
		$address = new XT_Address();

		// Update values
		$address->setFirstName($row['firstName']);
		$address->setLastName($row['lastName']);
		$address->setPostalCode($row['plz']);
		$address->setCity($row['city']);
		$address->setImage($row['image']);
		if($address->getTitle() == ""){
		    $address->generateTitle();
		}
		// TODO: Functions needs to be added to address entity class

		$address->setStreet($row['street']);
		$address->setEMail($row['email']);
		$address->setTelephone($row['tel']);
		$address->setFacsimile($row['facsimile']);
		$address->setDescription($row['description']);
		$address->setuserid($uid);
		// Commit changes
		$address->save();
		if ($row['active'] == 1) {
			$address->activate();
		}
	}
?>