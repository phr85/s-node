<?php
// include tables and property types config
include_once(PLUGIN_DIR . "ch.iframe.snode.properties/includes/config.ext.inc.php");
if($GLOBALS['plugin']->getValue('XT_PROP_property_id') != 0){

    //Default wert für die eigenschaft holen
    $defaultvalue = XT::getQueryData(XT::query("SELECT value, type from " . XT::getTable("properties") . " WHERE id=" . XT::getValue("XT_PROP_property_id"),__FILE__,__LINE__));

    // Typ0 Text passiert automatisch
    // Typ1 boolean immer auf true
    // Typ2 zahl immer auf 0

    // Defaultwert für dropdowns rausfinden (TYP 3)
    if ($defaultvalue[0]['type'] == 3){
        $tempval = explode('[;]',$defaultvalue[0]['value']);
        foreach ($tempval as $line) {
            $tmp = explode('[|]',$line);
            if($tmp[2] == 'default'){
                $defaultvalue[0]['value'] = trim($tmp[0]);
            }
        }
    }

    // Defaultwert für Checkboxen rausfinden (TYP 9)
    if ($defaultvalue[0]['type'] == 9){
        $tempval = explode('[;]',$defaultvalue[0]['value']);
        foreach ($tempval as $line) {
            $tmp = explode('[|]',$line);
            if($tmp[2] == 'default'){
                $defaultvalue[0]['value'] = trim($tmp[0]);
            }
        }
    }
    
    // Defaultwert für Multirel rausfinden (TYP /)
    if ($defaultvalue[0]['type'] == 6 || $defaultvalue[0]['type'] == 7 || $defaultvalue[0]['type'] == 10){
        $defaultvalue[0]['value'] = "";
    }

    //TODO default werte für typ 4+10 machen

    // datensatz einfügen
    XT::query("INSERT INTO
                   " . XT::getTable('values') . "
               ( `property_id`, `content_type`, `content_id`, `content_sub_id`, `lang`, `level`, `value`)
               VALUES
                   (
                   " . XT::getValue("XT_PROP_property_id") . ",
                   " . XT::getValue("XT_PROP_content_type") . ",
                   " . XT::getValue("XT_PROP_content_id") . ",
                   " . XT::getValue("XT_PROP_content_sub_id") * 1 . ",
                   '" . XT::getPluginLang() . "',
                   1,
                   '" . $defaultvalue[0]['value']. "'
                   )" ,__FILE__,__LINE__);
}

?>