<?php

// Get ID of Google Map that has to be edited
$id =  XT::getValue("id");

// SQL
$result = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('googlemaps') . " as maps
    LEFT JOIN
    	" . XT::getTable('googlemaps_lang') . " as maps_lang ON (maps.id = maps_lang.map_id AND maps_lang.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    WHERE
        maps.id = " . $id . "
    ",__FILE__,__LINE__);

$rset = XT::getQueryData($result);
$data['map'] = $rset[0];

// SQL
$result = XT::query("
    SELECT
       entries.*,
       entries_lang.*,
       address.title as addr_title,
       address.street as addr_street,
       address.postalCode as addr_postalCode,
       address.city as addr_city
    FROM
        " . XT::getTable('googlemaps_entries') . " as entries
    LEFT JOIN
    	" . XT::getTable('googlemaps_entries_lang') . " as entries_lang ON (entries.id = entries_lang.entry_id AND entries_lang.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
    LEFT JOIN
    	" . XT::getTable("addresses") . " as address ON (entries.addr_id = address.id)
    WHERE
        entries.map_id = " . $id . "
    ORDER BY
    	entries.position ASC
    ",__FILE__,__LINE__);

$rset = XT::getQueryData($result);
$data['addresses'] = $rset;

if(XT::getPermission('edit')){
	/* Save Map */
	XT::addImageButton("Save","saveMap","default","disk_blue.png","0","slave1");
	XT::addImageButton("Save and close","saveMapAndClose","default","save_close.png","0","slave1");

    /* Save Addresss *//*
	XT::addImageButton("Save addresses","saveAddress","map","disk_blue.png","0","slave1");
	XT::addImageButton("Save and close addresses","saveAddressAndClose","map","save_close.png","0","slave1");
	*/

	/* Add answer */
    XT::addImageButton('Add Address', 'addAddress', 'map',"document_new.png","0","","o");
}

// By standard enabled buttons //
XT::assign('BUTTONS_MAP',$GLOBALS['plugin']->getButtons('default'));

// Buttons to save addresses //
XT::assign('BUTTONS_MAP_OPTIONS',$GLOBALS['plugin']->getButtons('map'));

XT::assign("ERRORS", XT::getActionStopped());
XT::assign("DATA",$data);

XT::assign("ADDRESS", $result->fetchRow());

// Images
XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

// Address
XT::assign("ADDR_PICKER_TPL", XT::getConfig("ADDR_PICKER_TPL"));

$content = XT::build('edit.tpl');

?>