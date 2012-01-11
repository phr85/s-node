<?php
// Base id
XT::setBaseID(5100);

// Tables
XT::addTable("events");
XT::addTable("events_details");
XT::addTable("events_tree");
XT::addTable("events_tree_rel");
XT::addTable("events_tree_details");
XT::addTable("events_registrations");
XT::addTable("events_registrations_details");
XT::addTable("addresses");
XT::addTable("forms");
XT::addTable('countries');
XT::addTable('countries_detail');
XT::addTable('countries_regions');

// Tabs
XT::addTab("o", "Overview", "overview.php", true, true);
XT::addTab("e", "Edit", "edit_event.php", false, false);
XT::addTab('en','Edit node','edit_node.php',false,false);
XT::addTab('ro','Registrations','registrations.php',false, false);
XT::addTab('er','Edit registration','edit_registration.php',false,false);
XT::addTab("slave1", "slave1", "slave1.php",false, false);

// Addresspicker template
XT::addConfig("ADDR_PICKER_TPL", 281);

// Image picker
XT::addConfig("image_picker_base_id", 240, "");
XT::addConfig("image_picker_tpl", 597, "");

// Image picker
XT::addConfig("form_picker_base_id", 220, "");
XT::addConfig("form_picker_tpl", 301, "");


// relations
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.relations.zl")){
    $display['relations']=true;
}

// properties
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.properties.zl")){
    $display['properties']=true;
    XT::addConfig('display_properties', true, '');
    // use universal properties
    $display['properties_universal']=false;
}

XT::assign("DISPLAY",$display);

// Permissions
XT::enablePermissions();
?>