<?php

set_time_limit(0);

// Filter Bestandteile zusammenstellen
if(intval(XT::getValue("scategory_id_")) > 0) {
    $cat_filter = "cat.id = " . intval(XT::getValue("scategory_id_"));
}
if(XT::getValue("lang") != "") {
    $lang_filter = "sub.lang = '" . XT::getValue("lang") . "'";
}

// SQL Filter bauen
if($cat_filter != "" && $lang_filter != "") {
    $filter = " WHERE {$cat_filter} AND {$lang_filter} ";
}
elseif($cat_filter != "") {
    $filter = " WHERE {$cat_filter} ";
}
elseif($lang_filter != "") {
    $filter = " WHERE {$lang_filter} ";
}
else {
    $filter = "";
}

// Alle Abonnenten zusammenstellen welche den Filter regeln entsprechen
$result = XT::query("
    SELECT
        sub.*,
        cat.title as cat_title
    FROM
        " . XT::getTable("newsletter_subscriptions") . " as sub
    LEFT JOIN
        " . XT::getTable("newsletter_subscr2cat") . " as sub2cat on (sub2cat.subscription_id = sub.id)
    LEFT JOIN
        " . XT::getTable("newsletter_categories") . " as cat on (cat.id = sub2cat.category_id)
    " . $filter . "
    ORDER BY
        sub.email,
        cat.title
",__FILE__,__LINE__);

$data = array();

while($row = $result->fetchRow()) {
    $data[$row['id']][0] = $row['email'];
    $data[$row['id']][1] = $row['anrede'];
    $data[$row['id']][2] = $row['firstname'];
    $data[$row['id']][3] = $row['lastname'];
    $data[$row['id']][4] = $row['company'];
    $data[$row['id']][5] = $row['mobile'];
    $data[$row['id']][6] = $row['lang'];
    /**
     * Da wir noch MYSQL 4.0 unterstuetzen, konnte ich keinen GROUP_CONCAT
     * (http://dev.mysql.com/doc/refman/4.1/en/group-by-functions.html#function_group-concat) nehmen
     */
    if(!isset($data[$row['id']][7]) || $data[$row['id']][7] == "") {
        $data[$row['id']][7] = $row['cat_title'];
    }
    else {
        $data[$row['id']][7] = "{$data[$row['id']][7]};{$row['cat_title']}";
    }
    $data[$row['id']][8] = $row['id'];
}

// Das CSV erstellen
XT::loadClass('csv.class.php','ch.iframe.snode.core');
$csv = new csv("newsletter.csv");
$csv->fieldSeperator = ";";
$csv->data = $data;
$csv->sendData();
exit;

?>