<?php

// Save location data
XT::query("
    UPDATE
        " . XT::getTable('company_locations') . "
    SET
        title = '" . XT::getValue('title') . "',
        description = '" . XT::getValue('description') . "',
        country = '" . XT::getValue('country') . "',
        city = '" . XT::getValue('city') . "',
        cityCode = '" . XT::getValue('cityCode') . "'
    WHERE
        id = '" . XT::getSessionValue('location_id') . "'
",__FILE__,__LINE__);

// Search indexing
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex(XT::getSessionValue("location_id"),XT::getContentType("Company location"),0);
$search->build(XT::getValue("title"), XT::getValue("description"));

if(XT::getValue("image") > 0){
    $search->setImage(XT::getValue("image"));
}

// Hold module
XT::setAdminModule('e');

?>
