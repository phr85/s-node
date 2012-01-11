<?php

/*
 * universeller Adressexporter inkl. Properties
 * D.Zogg
 *
 */

// Den Filter auf den Titel einbauen
XT::enableAdminCharFilter("a.title");

// Filter auf den Addresstyp einbauen (-2 => nicht definiert, -1 => Alle, ab > 0 definierte Typen)
$filtertype = XT::autoval('filtertype',"R",-1);

if($filtertype == -1) {
    $sql_where = XT::getAdminCharFilter() ;
}
elseif($filtertype >= 0) {
    if(XT::getAdminCharFilter()) {
        $sql_where = " " . XT::getAdminCharFilter() . " AND a.type = " . $filtertype . " ";
    }
    else {
        $sql_where = " WHERE a.type = " . $filtertype . " ";
    }
}
if($filtertype == -2) {
    if(XT::getAdminCharFilter()) {
        $sql_where = " " . XT::getAdminCharFilter() . " AND a.type = 0 ";
    }
    else {
        $sql_where = " WHERE a.type = 0 ";
    }
}

// Falls Properties installiert und lizenziert sind diese auch beruecksichtigen
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.properties.zl")) {

    // Die Properties abrufen
    $result = XT::query("
        SELECT
            id
        FROM
            " . XT::getTable("properties") . "
        WHERE
            content_type = 7400 OR
            content_type = 0
    ",__FILE__,__LINE__);

    $selects = "";
    $joins = "";

    while($row = $result->FetchRow()) {
        $selects .= ",prop" . $row['id'] . ".value as prop" . $row['id'];
        $joins .= " LEFT JOIN xt_properties_values AS prop" . $row['id'] . " ON (prop" . $row['id'] . ".property_id = " . $row['id'] . " AND prop" . $row['id'] . ".content_id = a.id) ";
    }

}

// Die Adressen inkl. der Propertie Werten abrufen
$result = XT::query("
    SELECT
        a.*
        " . $selects . "
    FROM
        " . XT::getTable("addresses") . " as a
        " . $joins . "
        " . $sql_where . "
    GROUP BY
        a.id
    ORDER BY
        a.title
",__FILE__,__LINE__);

$res = XT::getQueryData($result);

$xls_values = array();
$i = 1;
$date_format_str = "d.m.Y H:i:s";

// Den Array fuer den Export vorbereiten
foreach($res as $key => $addressvalues) {
    $y = 0;
    foreach($addressvalues as $addresselementkey => $addresselementvalue) {
        if($i == 1) {
            $xls_values[0][$y] = $addresselementkey;
        }
        switch($addresselementkey) {
            case "creation_date": $xls_values[$i][$y] = date($date_format_str, $addresselementvalue); break;
            case "mod_date": $xls_values[$i][$y] = $addresselementvalue > 0 ? date($date_format_str, $addresselementvalue) : ''; break;
            case "birthdate": $xls_values[$i][$y] = $addresselementvalue > 0 ? date("d.m.Y", $addresselementvalue) : ''; break;
            case "birthday": $xls_values[$i][$y] = $addresselementvalue > 0 ? date("d.m", $addresselementvalue) : ''; break;
            default: $xls_values[$i][$y] = $addresselementvalue; break;
        }
        $y++;
    }
    $i++;
}

// xls Klasse laden
XT::loadClass('xls.class.php','ch.iframe.snode.addresses');

$xls = new xls("addresses.xls");
$xls->addData($xls_values);
$xls->sendData();

exit;

?>