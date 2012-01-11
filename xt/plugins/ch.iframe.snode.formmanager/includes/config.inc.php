<?php

// Base ID
$GLOBALS['plugin']->setBaseID(220);

// Tables used in this plugin
XT::addTable("user");
XT::addTable("workflows");
XT::addTable("forms");
XT::addTable("navigation_details");
XT::addTable("forms_fillouts");
XT::addTable("forms_data");
XT::addTable("forms_scripts");
XT::addTable("forms_actions");
XT::addTable("forms_preactions");
XT::addTable("forms_elements");
XT::addTable("forms_elements_rules");
XT::addTable("forms_elements_values");

// Administration tabs
XT::addTab('o',"Overview","overview.php",true,true);
XT::addTab('s',"Scripts","scripts.php",false,true);
XT::addTab('import',"Import","import.php",false,true);
XT::addTab('es',"Edit script","editScript.php",false,false);
XT::addTab('ef',"Edit form","editForm.php",false,false);
XT::addTab('ee',"Edit form element","editElement.php",false,false);
XT::addTab('ea',"Edit form action","editAction.php",false,false);
XT::addTab('epa',"Edit form preaction","editPreAction.php",false,false);
XT::addTab('eer',"Edit form element rule","editElementRule.php",false,false);
XT::addTab('eev',"Edit form element value","editElementValue.php",false,false);
XT::addTab('slave1','Slave1','slave1.php',false,false);


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

// Administration tabs :: Relations
$GLOBALS['plugin']->addTabRelation('ee','ef');
$GLOBALS['plugin']->addTabRelation('eer','ef');
$GLOBALS['plugin']->addTabRelation('eer','ee');
$GLOBALS['plugin']->addTabRelation('ea','ef');
$GLOBALS['plugin']->addTabRelation('eev','ee');
$GLOBALS['plugin']->addTabRelation('eev','ef');

// Configuration variables
$GLOBALS['plugin']->addConfig('display_errors_inline', false, 'Display Error Messages below the corresponding Field');
$GLOBALS['plugin']->addConfig('admin_tpl', 634, '');
$GLOBALS['plugin']->addConfig('viewer_tpl', 635, '');
$GLOBALS['plugin']->addConfig('field_types', array(

    0 =>    $GLOBALS['lang']->msg("Display") . ": " . $GLOBALS['lang']->msg("Text"),
    8 =>    $GLOBALS['lang']->msg("Display") . ": " . $GLOBALS['lang']->msg("Separator (with heading)"),
    6 =>    $GLOBALS['lang']->msg("Display") . ": " . $GLOBALS['lang']->msg("Group"),

    1 =>    $GLOBALS['lang']->msg("Input") . ": " . $GLOBALS['lang']->msg("Text"),
    11 =>   $GLOBALS['lang']->msg("Input") . ": " . $GLOBALS['lang']->msg("Multiline Text"),
    7 =>    $GLOBALS['lang']->msg("Input") . ": " . $GLOBALS['lang']->msg("Password"),
  //  9 =>    $GLOBALS['lang']->msg("Input") . ": " . $GLOBALS['lang']->msg("City code / City"),
  //  10 =>   $GLOBALS['lang']->msg("Input") . ": " . $GLOBALS['lang']->msg("Street / Nr"),

    2 =>    $GLOBALS['lang']->msg("Select") . ": " . $GLOBALS['lang']->msg("Single choice (Dropdown)"),
    3 =>    $GLOBALS['lang']->msg("Select") . ": " . $GLOBALS['lang']->msg("Single choice (Radio)"),
    4 =>    $GLOBALS['lang']->msg("Select") . ": " . $GLOBALS['lang']->msg("Multiple choice (List)"),
    5 =>    $GLOBALS['lang']->msg("Select") . ": " . $GLOBALS['lang']->msg("Multiple choice (Checkbox)"),
    15 =>   $GLOBALS['lang']->msg("Select") . ": " . $GLOBALS['lang']->msg("Datepicker"),

    12 =>   $GLOBALS['lang']->msg("Special") . ": " . $GLOBALS['lang']->msg("Hidden field"),
    13 =>   $GLOBALS['lang']->msg("Special") . ": " . $GLOBALS['lang']->msg("Fileupload"),
    14 =>   $GLOBALS['lang']->msg("Special") . ": " . $GLOBALS['lang']->msg("Captcha"),

    ),''
);

// 12 =>   $GLOBALS['lang']->msg("Input") . ": " . $GLOBALS['lang']->msg("File Upload"),
// 6 =>    $GLOBALS['lang']->msg("Select") . ": " . $GLOBALS['lang']->msg("Yes / No (Checkbox)"),

$GLOBALS['plugin']->addConfig('action_types', array(
    1 =>    $GLOBALS['lang']->msg("Redirect (External)"),
    2 =>    $GLOBALS['lang']->msg("Send mail"),
    3 =>    $GLOBALS['lang']->msg("Call script"),
    4 =>    $GLOBALS['lang']->msg("Call form"),
    5 =>    $GLOBALS['lang']->msg("Send internal message"),
    7 =>    $GLOBALS['lang']->msg("Redirect (Internal)"),
    ),''
);

XT::addContentType(220, 'Form');
XT::addContentType(221, 'Form Element');
XT::addContentType(222, 'Form Action');
XT::addContentType(223, 'Form Rule');

// Enable permissions
$GLOBALS['plugin']->enablePermissions();

?>