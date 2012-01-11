<?php

/*
XT::loadClass('address.class.php','ch.iframe.snode.addresses');
$address = new XT_Address(140);
$address->export('vCard');
$address->export('XML');
*/

// Add buttons
XT::addImageButton('<u>N</u>ew address','addAddress','default','add.png','1','master','n');

// Handle order requests
if(XT::getValue("order_by") != ''){
    XT::setSessionValue("order_by", XT::getValue("order_by"));
}
if(XT::getValue("order_by_dir") != ''){
    XT::setSessionValue("order_by_dir", XT::getValue("order_by_dir"));
}
if(XT::getSessionValue('order_by') != '' && XT::getSessionValue('order_by_dir') != ''){
    $order_by = XT::getSessionValue('order_by') . ' ' . XT::getSessionValue('order_by_dir');
} else {
    $order_by = 'a.title ASC';
    XT::setSessionValue('order_by','title');
    XT::setSessionValue('order_by_dir','asc');
}

// Handle search
$search = '';
if(XT::getValue('search') != ''){
    if(is_numeric(XT::getValue('search')) && XT::getValue('search_field') == 'a.title'){
        $search = "WHERE a.id = '" . XT::getValue('search') . "'";
    } else {
        $search = "WHERE " . XT::getValue('search_field') . " LIKE '%" . XT::getValue('search') . "%'";
    }
}

// Enable navigator
if(XT::getValue('search') != ''){
    $search_tmp = str_replace('a.','',$search);
    XT::enableAdminNavigator('addresses','',"
    SELECT count(id) as count_id FROM " . XT::getTable('addresses') . " " . $search_tmp . "
    ");
} else {
    XT::enableAdminNavigator('addresses');
}

// Get addresses
$result = XT::query("
    SELECT
        a.title,
        a.id,
        a.type,
        a.email,
        a.website,
        a.status,
        a.tel,
        a.city,
        a.postalCode,
        a.street,
        a.display_time_type,
        a.display_time_start,
        a.display_time_end,
        b.title as company,
        b.id as company_id,
        d.name as region,
        d.short as regioncode,
        c.name as country,
        c.country as countrycode
    FROM
        " . XT::getTable('addresses') . " as a LEFT JOIN
        " . XT::getTable('addresses') . " as b ON (b.id = a.organization) LEFT JOIN
        " . XT::getTable('countries_regions') . " as d ON (d.region = a.state AND d.country = a.country) LEFT JOIN
        " . XT::getTable('countries') . " as c ON (c.country = a.country)
    " . $search . "
    GROUP by a.id 
    ORDER BY 
        " . $order_by . "
    LIMIT " . XT::getAdminNavigatorLimit() . "
",__FILE__,__LINE__,0);

$data = array();
while($row = $result->FetchRow()){
    $row['countrycode'] = strtolower($row['countrycode']);
    if(($row['display_time_start'] < TIME && $row['display_time_end'] > TIME) || ($row['display_time_start'] < TIME && $row['display_time_end'] == 0) || ($row['display_time_start'] ==0  && $row['display_time_end'] > TIME) ){
        $row['timer'] = 'running';
    }else {
        $row['timer'] = 'ready';
    }
    if ($row['display_time_end'] < TIME && $row['display_time_end'] != 0)   {
        $row['timer'] = 'expired';
    }
    if ($row['display_time_start'] == 0 && $row['display_time_end'] == 0)   {
        $row['timer'] = 'unused';
    } 
    $data[] = $row;
}

XT::assign("ADDRESSES", $data);
XT::assign("ORDER_BY_DIR", XT::getSessionValue('order_by_dir'));
XT::assign("ORDER_BY", XT::getSessionValue('order_by'));

$content = XT::build('overview.tpl');

?>