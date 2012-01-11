<?php

// Image Zoom enabled?
if(XT::getValue("image_zoom")==1){
    $image_zoom = 1;
}else{
    $image_zoom = 0;
}

// Errors that have to be displayed but wont keep the action from being executed come into this array
$nc_errors = null;

// G Maps Key
$key = XT::getConfig('api-key');

// Map Address to be entered in DB
$map_address = XT::getValue('address',9100);
$map_latitude = XT::getValue('latitude',9100);
$map_longitude = XT::getValue('longitude',9100);
$map_c = XT::getValue('map_c',9100);

// Get Map Address type
$map_address_type = XT::getValue('address_type',9100);
$map_address_type = explode("_",$map_address_type);
$map_address_type = $map_address_type[0];

// Check if everything was entered.
$map_address_qry = str_replace(" ","%20", strip_tags($map_address));


// SQL
$result = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('googlemaps') . " as maps
    LEFT JOIN
    	" . XT::getTable('googlemaps_lang') . " as maps_lang ON (maps_lang.map_id = maps.id)
    WHERE
        maps_lang.lang = '" . XT::getActiveLang() . "'
        AND
        maps.id = '" . XT::getValue('id') . "'
    LIMIT
        " . $GLOBALS['plugin']->getLimiter() . "
    ",__FILE__,__LINE__);

	
	$row = $result->FetchRow();
	
// If coordinates are not empty and different from those already in the DB
if ($map_address_type == 1){
		if ($map_address != ""){
		// If address doesn't match the one in the DB
	 		if ($map_address != $row['address']){
				//Get Coordinates from the given address
				$qryAdress= "http://maps.google.com/maps/geo?q=" . $map_address_qry . "&output=xml&key=" . $key; 
				
				//Get Google's XML File
				$urlContent=file_get_contents($qryAdress); 
				
				//Convert file to utf8
				$urlContent = utf8_decode($urlContent); 
				
				//Create Simple XML Element
				$xml = new SimpleXMLElement($urlContent); 
				
				//Read coordinates and save them to 3 variables
				list($map_longitude, $map_latitude, $map_altitude) = explode(",",$xml->Response->Placemark->Point->coordinates);
					
				// perform Map save operation with latitude and longitude
				XT::query("
				    UPDATE
				        " . XT::getTable('googlemaps') . "
				    SET
				        c_date = " . time() . ",
				        c_user = " . XT::getUserID(). ",
				        image = '" . XT::getValue('image',9100) . "',
				        image_version = '" . XT::getValue('image_version',9100) . "',
				        image_zoom = '" . $image_zoom . "',
				        address_type = '" . $map_address_type . "',
				        type = '" . XT::getValue('mapType',9100) . "',
				        zoom = '" . XT::getValue('zoomLevel',9100) . "',
				        address = '" . $map_address . "',
				        latitude = '" . $map_latitude . "',
				        longitude = '" . $map_longitude . "'
				    WHERE
				        id = '" . XT::getValue('id') . "'"
				,__FILE__,__LINE__);
				
				if ($map_c == 1){
					XT::query("
					    UPDATE
					        " . XT::getTable('googlemaps_lang') . "
					    SET
					        title = '" . XT::getValue('title',9100) . "',
					        description = '" . XT::getValue('description',9100) . "',
					        lang = '" . XT::getActiveLang() . "'
					    WHERE
					        map_id = '" . XT::getValue('id') . "'
					    AND
					        lang = '" . XT::getActiveLang() . "'"
					,__FILE__,__LINE__);
				}else{
					XT::query("
					    INSERT INTO
					        " . XT::getTable('googlemaps_lang') . "
					    SET
					        title = '" . XT::getValue('title',9100) . "',
					        description = '" . XT::getValue('description',9100) . "',
					        lang = '" . XT::getActiveLang() . "',
					        map_id = '" . XT::getValue('id') . "',
					        c = '1'"
					,__FILE__,__LINE__);
				}
			}else{
			// perform Map save operation without latitude and longitude
			XT::query("
			    UPDATE
			        " . XT::getTable('googlemaps') . "
			    SET
			        c_date = " . time() . ",
			        c_user = " . XT::getUserID(). ",
			        image = '" . XT::getValue('image',9100) . "',
			        image_version = '" . XT::getValue('image_version',9100) . "',
			        image_zoom = '" . $image_zoom . "',
			        address_type = '" . $map_address_type . "',
			        type = '" . XT::getValue('mapType',9100) . "',
			        zoom = '" . XT::getValue('zoomLevel',9100) . "'
			    WHERE
			        id = '" . XT::getValue('id') . "'"
			,__FILE__,__LINE__);
			
				if ($map_c == 1){
					XT::query("
					    UPDATE
					        " . XT::getTable('googlemaps_lang') . "
					    SET
					        title = '" . XT::getValue('title',9100) . "',
					        description = '" . XT::getValue('description',9100) . "',
					        lang = '" . XT::getActiveLang() . "'
					    WHERE
					        map_id = '" . XT::getValue('id') . "'
					    AND
					        lang = '" . XT::getActiveLang() . "'"
					,__FILE__,__LINE__);
				}else{
					XT::query("
					    INSERT INTO
					        " . XT::getTable('googlemaps_lang') . "
					    SET
					        title = '" . XT::getValue('title',9100) . "',
					        description = '" . XT::getValue('description',9100) . "',
					        lang = '" . XT::getActiveLang() . "',
					        map_id = '" . XT::getValue('id') . "',
					        c =  '1'"
					,__FILE__,__LINE__);
				}
		}
	}
}else{
	// perform Map save operation with latitude and longitude
	XT::query("
	    UPDATE
	        " . XT::getTable('googlemaps') . "
	    SET
	        c_date = " . time() . ",
	        c_user = " . XT::getUserID(). ",
	        image = '" . XT::getValue('image',9100) . "',
	        image_version = '" . XT::getValue('image_version',9100) . "',
	        image_zoom = '" . $image_zoom . "',
	        type = '" . XT::getValue('mapType',9100) . "',
	        zoom = '" . XT::getValue('zoomLevel',9100) . "',
	        address = '" . $map_address . "',
	        address_type = '" . $map_address_type . "',
	        latitude = '" . $map_latitude . "',
	        longitude = '" . $map_longitude . "'
	    WHERE
	        id = '" . XT::getValue('id') . "'"
	,__FILE__,__LINE__);
	
	if ($map_c == 1){
		XT::query("
		    UPDATE
		        " . XT::getTable('googlemaps_lang') . "
		    SET
		        title = '" . XT::getValue('title',9100) . "',
		        description = '" . XT::getValue('description',9100) . "',
		        lang = '" . XT::getActiveLang() . "'
		    WHERE
		        map_id = '" . XT::getValue('id') . "'
		    AND
		        lang = '" . XT::getActiveLang() . "'"
		,__FILE__,__LINE__);
	}else{
		XT::query("
		    INSERT INTO
		        " . XT::getTable('googlemaps_lang') . "
		    SET
		        title = '" . XT::getValue('title',9100) . "',
		        description = '" . XT::getValue('description',9100) . "',
		        lang = '" . XT::getActiveLang() . "',
		        map_id = '" . XT::getValue('id') . "',
		        c = '1'"
		,__FILE__,__LINE__);
	}
}


// Also save addresss...
$address_data = XT::getValue('address_data',9100);

// If there are any addresss.
if (is_array($address_data)){
	foreach ($address_data as $id=>$address){
		if($address['planer'] ==1){
		    $planer = 1;
		}else{
		    $planer = 0;
		}
		
		$addresstype = explode("_",$address['type']);
		
		$address['type'] = $addresstype[0];
		
		// Title entered?
		if (!$address['title']){
	   		$nc_errors[$address['id']]['title'] = XT::translate("Please fill in all Address Titles. Check below");
		// If user forgot to enter an address
		}
		
		if ($address['address_picked'] == ""){
			if ($address['address'] == "" AND ($address['latitude'] == "" AND $address['longitude'] == "")){
	   			$nc_errors[$address['id']]['address']= XT::translate("Please fill in an Address. Check below.");			
			}
		}
		
		$result = XT::query("
			    SELECT
			    	*
			    FROM
			        " . XT::getTable('googlemaps_entries') . " as entries
		        LEFT JOIN
    				" . XT::getTable('googlemaps_entries_lang') . " as entries_lang ON (entries.id = entries_lang.entry_id AND entries_lang.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
			    WHERE
			        entries.id = " . $address['id'] . ""
			,__FILE__,__LINE__);
		
		$row = $result->FetchRow();
		
		if ($address['type'] == 1){
			if ($address['address_picked'] != 0){
				$result = XT::query("
				    SELECT
				        id,
				        title,
				        street,
				        postalCode,
				        city
				    FROM
				        " . XT::getTable("addresses") . "
				    WHERE
				        id=" . $address['address_picked']
				,__FILE__,__LINE__);
				
				$address_details = $result->fetchRow();
							
                $address_details_clean = array();
                
                foreach($address_details as $detailkey => $detail) {
                    $address_details_clean[$detailkey] = str_replace(",", "%20", str_replace(" ","%20", strip_tags($detail)));
                }
                
				$location = $address_details_clean['street'] . ",%20" . $address_details_clean['postalCode'] . ",%20" . $address_details_clean['city']; 
				
				//Get Google Maps coordinates if not empty
				if ($location != ""){
						//Get Coordinates from the given address
						$qryAdress= "http://maps.google.com/maps/geo?q=" . $location . "&output=xml&key=" . $key;
						
						//Get Google's XML File
						$urlContent=file_get_contents($qryAdress); 
						
						//Convert file to utf8
						$urlContent = utf8_decode($urlContent); 
						
						//Create Simple XML Element
						$xml = new SimpleXMLElement($urlContent); 
						
						//Read coordinates and save them to 3 variables
						list($longitude, $latitude, $altitude) = explode(",",$xml->Response->Placemark->Point->coordinates);
							
						if($latitude == "" OR $longitude == ""){
							$nc_errors[$row['id']]['coordinates'] = XT::translate("Sorry. Address " . $address['address'] . " not found. Try to be more precise and hit 'save map' again.");
						}else{
							$address['longitude'] = $longitude;
							$address['latitude'] = $latitude;
							XT::setValue('location',$location);
							$address['location'] = $location;
						}
				}
			}
		}
			
		if ($address['type'] == 2){
			// GMAP
			$location = strip_tags($address['address']);
			$location = str_replace(" ","%20", $location);
			
			//Get Google Maps coordinates if not empty
			if ($location != ""){
				if ($address['address'] != $row['address']){
					//Get Coordinates from the given address
					$qryAdress= "http://maps.google.com/maps/geo?q=" . $location . "&output=xml&key=" . $key; 
					
					//Get Google's XML File
					$urlContent=file_get_contents($qryAdress); 
					
					//Convert file to utf8
					$urlContent = utf8_decode($urlContent); 
					
					//Create Simple XML Element
					$xml = new SimpleXMLElement($urlContent); 
					
					//Read coordinates and save them to 3 variables
					list($longitude, $latitude, $altitude) = explode(",",$xml->Response->Placemark->Point->coordinates);
						
					if($latitude == "" OR $longitude == ""){
						$nc_errors[$row['id']]['coordinates'] = XT::translate("Sorry. Address " . $address['address'] . " not found. Try to be more precise and hit 'save map' again.");
					}else{
						$address['longitude'] = $longitude;
						$address['latitude'] = $latitude;
						XT::setValue('location',$location);
						$address['location'] = $location;
					}
				}else{
					$address['longitude'] = $row['longitude'];
					$address['latitude'] = $row['latitude'];
				}
			}
		}
		
		// if its address type 3 do nothing. coordinates will be already in the right variable
		
		// Was there a modified icon given?
		if (xt::getValue('icon'.$id,9100)){
			$icon = xt::getValue('icon'.$id,9100);
		}else{
			$icon = "";
		}
		
		// Perform Save operation
		XT::query("
		    UPDATE
		        " . XT::getTable('googlemaps_entries') . "
		    SET
		        address = '" . $address['address'] . "',
		        addr_id = '" . $address['address_picked'] . "',
		        latitude = '" . $address['latitude'] . "',
		        longitude = '" . $address['longitude'] . "',
		        image = '" . xt::getValue('image'.$id,9100) . "',
		        image_version = '" . xt::getValue('image'.$id.'_version',9100) . "',
		        planer = '" . $planer . "',
		        type = '" . $address['type'] . "',
		        icon = '" . $icon . "'
		    WHERE
		        id = '" . $address['id'] . "'"
		,__FILE__,__LINE__);
		
		
		if ($address['c'] == 1){
			XT::query("
			    UPDATE
			        " . XT::getTable('googlemaps_entries_lang') . "
			    SET
			        title = '" . $address['title'] . "',
			        description = '" . $address['description'] . "',
			        lang = '" . XT::getActiveLang() . "'
			    WHERE
			        entry_id = '" . $address['id'] . "'
			    AND
			        lang = '" . XT::getActiveLang() . "'"
			,__FILE__,__LINE__);
		}else{
			XT::query("
			    INSERT INTO
			        " . XT::getTable('googlemaps_entries_lang') . "
			    SET
			        title = '" . $address['title'] . "',
			        description = '" . $address['description'] . "',
			        lang = '" . XT::getActiveLang() . "',
			        entry_id = '" . $address['id'] . "',
			        c = '1'"
		,__FILE__,__LINE__);
		}
	}
}

// Set Admin Module to "edit"
XT::setAdminModule("edit");

// Assign Errors, Non Crucial ones too
XT::assign("ERRORS", XT::getActionStopped());
XT::assign("NON_CRUCIAL_ERRORS", $nc_errors);

?>