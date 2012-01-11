<?php

XT::setBaseID(7400);

XT::addTable('addresses');
XT::addTable('countries_regions');
XT::addTable('countries');
XT::addTable('countries_detail');
XT::addTable('data_perms');
XT::addTable('properties');
XT::addTable('properties_details');
XT::addTable('properties_values');
XT::addTable('relations');
XT::addTable('category_tree');
XT::addTable('category_nodes');
XT::addTable('user');
XT::addTable('user_roles');
XT::addTable('newsletter_subscriptions');

XT::addTab('o','Overview','overview.php',true,true);
XT::addTab('e','Edit','edit.php',false,false);
XT::addTab('slave1','slave1','slave1.php',false,false);
XT::addTab('import','import','import.php',false,true);

XT::addConfig("image_picker_base_id", 240, "Image picker base id");
XT::addConfig("image_picker_tpl", 597, "Image picker tpl");

XT::addContentType(7400,'Address');


// relations
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.relations.zl")){
    $display['relations'] = true;
}

// properties
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.properties.zl")){
    $display['properties'] = true;
    // use universal properties
    $display['properties_universal']=false;
}

// properties
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.securitycenter.zl")){
    $display['securitycenter'] = true;
}

include("addressinfos.config.inc.php");
XT::addConfig("ADDRESSTYPES", $address_types);
XT::addConfig("ADDRESSSTATES", $address_states);
XT::addConfig("required_fields",$address_required_fields);

// Zeitsteuerung
$display['time'] = true;

XT::assign("DISPLAY",$display);

XT::enablePermissions();

?>