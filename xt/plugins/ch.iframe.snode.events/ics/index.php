<?php

/*
 * Erstellt von D.Zogg
 * Dieses Modul wird per ajax.php aufgerufen und liefert direkt eine ics Datei zurueck
 *
 */

include(PLUGIN_DIR . 'ch.iframe.snode.events/includes/ics.config.inc.php');
XT::loadClass('ics.class.php','ch.iframe.snode.events');

// Param :: id (commaseperated values, default = 0)
$ids_input = explode(",", XT::getParam("id"));
$data["params"]["ids"] = "";
foreach($ids_input as $id) {
    if(intval($id) > 0) {
        $data["params"]["ids"] .= intval($id) . ",";
    }
}
if($data["params"]["ids"] != "") {
    $data["params"]["ids"] = substr($data["params"]["ids"], 0, -1);
}
else {
    $data["params"]["ids"] = 0;
}

// Param :: category (int, default = 0)
$data["params"]["category"] = intval(XT::getParam("category")) > 0 ? intval(XT::getParam("category")) : 0;

// Param :: recursive (bool, default = false)
$data["params"]["recursive"] = XT::getParam("recursive") == true ? XT::getParam("recursive") : false;

// Search recursive
if($data["params"]["recursive"]) {
    $result = XT::query("
        SELECT
            *
        FROM
            " .  XT::getTable("events_tree")  . "
        WHERE
            id IN (" . $data["params"]["category"] . ")
    ",__FILE__,__LINE__);
    while ($row = $result->fetchRow()) {
        $sub_result = XT::query("
            SELECT DISTINCT
                id
            FROM
                " . XT::getTable("events_tree")  . "
            WHERE
                l >= " . $row["l"] . " AND
                r <= " . $row["r"] . "
        ",__FILE__,__LINE__);
        while ($sub_row = $sub_result->fetchRow()) {
            $subcategories[] = $sub_row['id'];
        }
    }
    if(is_array($subcategories)) {
        $data["params"]["category"] .= "," . implode(",",$subcategories);
    }
}

// Param :: range (str, default = "this_month")
$data["params"]["range"] = is_array($calendar_time_range[XT::getParam("range")]) ? $calendar_time_range[XT::getParam("range")] : $calendar_time_range["this_month"];

//echo date("d.m.Y-H:i:s", $data["params"]["range"]['from']) . "<br />" . date("d.m.Y-H:i:s", $data["params"]["range"]['to']);

// Param :: calname (str, default = "calendar")
$data["params"]["calname"] = trim(XT::getParam("calname")) != "" ? trim(XT::getParam("calname")) : "calendar.ics";

// Query for ids
if($data["params"]["ids"] != "") {
    $query = "
        SELECT
            main.id,
            det.creation_date,
            main.from_date,
            main.end_date,
            det.title,
            det.maintext as text,
            CONCAT(address.title, ', ', address.street, ', ', address.postalCode, ' ', address.city, ', ', country.name) as location
        FROM
            " . XT::getTable("events") . " as main
        LEFT JOIN
            " . XT::getTable("events_details") . " as det ON (main.id = det.id AND det.lang = '" . XT::getLang() . "')
        LEFT JOIN
            " . XT::getTable("addresses") . " as address ON (main.address = address.id AND address.title != '' AND address.street != '' AND address.postalCode != '' AND address.city != '' AND address.country != '')
        LEFT JOIN
            " . XT::getTable("countries_detail") . " as country ON (address.country = country.country AND country.lang = '" . XT::getLang() . "')
        WHERE
            main.id IN(" . $data["params"]["ids"] . ")
        ORDER BY
            main.from_date
    ";
}
elseif($data["params"]["category"] != "") {
    $query = "
        SELECT
            main.id,
            det.creation_date,
            main.from_date,
            main.end_date,
            det.title,
            det.maintext as text,
            CONCAT(address.title, ', ', address.street, ', ', address.postalCode, ' ', address.city, ', ', country.name) as location
        FROM
            " . XT::getTable("events") . " as main
        INNER JOIN
            " . XT::getTable("events_tree_rel") . " as rel ON (rel.event_id = main.id)
        LEFT JOIN
            " . XT::getTable("events_details") . " as det ON (main.id = det.id AND det.lang = '" . XT::getLang() . "')
        LEFT JOIN
            " . XT::getTable("addresses") . " as address ON (main.address = address.id AND address.title != '' AND address.street != '' AND address.postalCode != '' AND address.city != '' AND address.country != '')
        LEFT JOIN
            " . XT::getTable("countries_detail") . " as country ON (address.country = country.country AND country.lang = '" . XT::getLang() . "')
        WHERE
            rel.node_id IN(" . $data["params"]["category"] . ") AND
            main.from_date BETWEEN " . $data["params"]["range"]["from"] . " AND " . $data["params"]["range"]["to"] . "
        ORDER BY
            main.from_date
    ";
}
else {
    $query = "
        SELECT
            main.id,
            det.creation_date,
            main.from_date,
            main.end_date,
            det.title,
            det.maintext as text,
            CONCAT(address.title, ', ', address.street, ', ', address.postalCode, ' ', address.city, ', ', country.name) as location
        FROM
            " . XT::getTable("events") . " as main
        LEFT JOIN
            " . XT::getTable("events_details") . " as det ON (main.id = det.id AND det.lang = '" . XT::getLang() . "')
        LEFT JOIN
            " . XT::getTable("addresses") . " as address ON (main.address = address.id AND address.title != '' AND address.street != '' AND address.postalCode != '' AND address.city != '' AND address.country != '')
        LEFT JOIN
            " . XT::getTable("countries_detail") . " as country ON (address.country = country.country AND country.lang = '" . XT::getLang() . "')
        WHERE
            main.from_date BETWEEN " . $data["params"]["range"]["from"] . " AND " . $data["params"]["range"]["to"] . "
        ORDER BY
            main.from_date
    ";
}

$result = XT::query($query,__FILE__,__LINE__);
$data['data']= XT::getQueryData($result);

$cal = new ics($data['data'], $data["params"]["calname"]);
$cal->return_calendar();

?>