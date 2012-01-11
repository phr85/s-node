<?php

XT::loadClass("ordering.class.php","ch.iframe.snode.core");

// Google API Key
$key = XT::getConfig('api-key');

if ($key == ""){
	$keyNotFound = true;
}

$order = new XT_Order("c_date,id,title","id",-1,"overview");

$order->setListener("sort","sortby");

XT::enableAdminNavigator('map','',"
    SELECT
        count(maps.id)
    FROM
        " . XT::getTable('googlemaps') . " as maps
    LEFT JOIN
    	" . XT::getTable('googlemaps_lang') . " as maps_lang ON (maps_lang.map_id = maps.id)
    WHERE
        maps_lang.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
");

if(XT::getPermission('administrator')){
    // Buttons
    XT::addImageButton("Add map", "addMap","default","document_new.png",0,"slave1");
}

// SQL
$result = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('googlemaps') . " as maps
    LEFT JOIN
    	" . XT::getTable('googlemaps_lang') . " as maps_lang ON (maps_lang.map_id = maps.id)
    WHERE
        maps_lang.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    " . $order->get() . "
    LIMIT
        " . $GLOBALS['plugin']->getLimiter() . "
    ",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

$content = XT::build('question_' . $style);
XT::assign("DATA", $data);
XT::assign("KEYNOTFOUND", $keyNotFound);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build("overview.tpl");

?>