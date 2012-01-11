<?php
@set_time_limit(0);
/**
 * Is a file posted
 */
if($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['error'] == 1){
	XT::log('upload error ',__FILE__,__LINE__,XT_ERROR);
}

//Check if the file has a valid name
if(isset($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']) && $_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'] != '' && substr($_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['name'],-4) == '.csv'){
	$csvFile = $_FILES['x' . $GLOBALS['plugin']->getBaseID() . '_file']['tmp_name'];

	// get all categories and their ids.
	$result = XT::query("SELECT * FROM " . XT::getTable("newsletter_categories") . " ORDER BY title ASC",__FILE__,__LINE__);
	$cats = XT::getQueryData($result);
	// Store the ids in the array dogs with the title as key
	foreach ($cats as $values) {
		$kategorien[$values['title']] = $values['id'];
	}

	// Load csv class
	XT::loadClass('csv.class.php','ch.iframe.snode.core');
	$csv = new csv($csvFile);
	$csv->fieldSeperator = ";";
	$csv->read();

	$now = TIME;
	$delivered_addresses =0;
	$valid_addresses =0;
	$updated_addresses =0;

	foreach ($csv->data as $address) {
		$delivered_addresses ++;
		$categories = array();
		$ignoreCategories = array();

		$email = str_replace(" ", "",($address[0]));
        $title = $address[1];
		$anrede = $address[2];
		$firstname = $address[3];
		$lastname = $address[4];
		$company = $address[5];
		$mobile = $address[6];
		$lang = strtolower($address[7]);
		$category = $address[8];
		$subscription_id = $address[9];

		// Only import if the email address is valid
		$valid_addresses ++;
		// Split categories
		if (strrchr($category, ";")) {
			$categories = explode(";",$category);
		} else {
			$categories[] = $category;
		}


		XT::query("UPDATE  " . XT::getTable("newsletter_subscriptions") . " set
				email = '" . $email . "',
				creation_date = '" . $now . "', 
				lang = '" . $lang . "',
                title = '" . addslashes($title) . "', 
				anrede = '" . addslashes($anrede) . "', 
				company = '" . addslashes($company) . "', 
				firstname = '" . addslashes($firstname) . "', 
				lastname = '" . addslashes($lastname) . "', 
				mobile = '" . addslashes($mobile) . "'
				where id = " . $subscription_id ,__FILE__,__LINE__);

		$updated_addresses ++;


		// Search for unsubscriptions of that user
		$sql = "SELECT * FROM " . XT::getTable("newsletter_unsubscribed") . " WHERE subscription_id='" . $subscription_id . "'";
		$result = XT::query($sql,__FILE__,__LINE__);
		while($row = $result->FetchRow()) {
			$ignoreCategories[] = $row['category_id'];
		}
		// Make the ralation between the user and each category
		foreach ($categories as $cat) {
			//search the id of the category
			if ($cat != "") {
				if ($kategorien[$cat] != "") {
					$catid = $kategorien[$cat];
				} else {
					// Insert a new category if it not exist
					XT::query("INSERT INTO  " . XT::getTable("newsletter_categories") . "
						(title,creation_date, creation_user)
						VALUES
						('" . $cat . "','" . $now . "','" . XT::getUserID() . "')
						",__FILE__,__LINE__);
					// Get the id of the new entry
					$result = XT::query("SELECT * FROM " . XT::getTable("newsletter_categories") . " WHERE creation_date='" . $now . "'",__FILE__,__LINE__);
					$row = $result->FetchRow();
					$catid = $row['id'];
					// Add the new categorie to the dogs array to prevent multible inserts
					$kategorien[$cat] = $catid;
				}
				// Make the relations
				if ((XT::getValue('ignoreunsubscribed') == "1" AND !in_array($catid,$ignoreCategories)) OR XT::getValue('ignoreunsubscribed') != "1") {
					// Delete first the relation to suppress warning if the relation still exist
					XT::query("DELETE FROM " . XT::getTable("newsletter_subscr2cat") . "
						WHERE
						category_id = " . $catid . " AND
						subscription_id = " . $subscription_id . "
						",__FILE__,__LINE__);
					// Insert the relation
					XT::query("INSERT INTO  " . XT::getTable("newsletter_subscr2cat") . "
						(category_id,subscription_id, type)
						VALUES
						('" . $catid . "','" . $subscription_id . "',0)
						",__FILE__,__LINE__);
				}

			}
		}
		$now++;
	}
	XT::log($delivered_addresses . " delivered, " . $valid_addresses . " valid , " . ($updated_addresses) . "  updated"  ,__FILE__,__LINE__,XT_INFO);
} else {
	XT::log('please use a .csv file',__FILE__,__LINE__,XT_ERROR);
}
XT::setAdminModule('update');
?>