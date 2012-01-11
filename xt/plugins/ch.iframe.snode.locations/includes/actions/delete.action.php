<?php

XT::query("DELETE FROM " . XT::getTable('company_locations') . " WHERE id = '" . XT::getValue('location_id') . "'");

XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex(XT::getSessionValue("location_id"),XT::getContentType("Company location"),0);
$search->delete();

?>
