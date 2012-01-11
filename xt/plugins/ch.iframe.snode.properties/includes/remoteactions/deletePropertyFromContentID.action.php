<?php
// include tables and property types config
include_once(PLUGIN_DIR . "ch.iframe.snode.properties/includes/config.ext.inc.php");
if($GLOBALS['plugin']->getValue('XT_PROP_property_id_action') != 0){

 if (XT::getValue("save_lang") != ""){
     $savelang = XT::getValue("save_lang");
 }else {
     $savelang = XT::getPluginLang();
 }
 
    if(!function_exists("deletePropertyFromContentID")) {
    
        function deletePropertyFromContentID($level,$savelang) {
        
            if(intval($level)) {
                $sqllevel = "AND `level` = " . $level;
            }
            else {
                $sqllevel = "";
            }
        
            // datensatz l�schen
            XT::query("
                DELETE FROM 
                    " . XT::getTable('values') . " 
                WHERE
                    `property_id` = " . XT::getValue("XT_PROP_property_id_action") . " AND
                    `content_id` = " . XT::getValue("XT_PROP_content_id") . " AND
                    `content_sub_id` = " . XT::getValue("XT_PROP_content_sub_id") * 1 . " AND
                    `lang` = '" . $savelang . "'
                    " . $sqllevel . "
            ",__FILE__,__LINE__);
        
        }
    
    }
    
    deletePropertyFromContentID($GLOBALS['plugin']->getValue('XT_PROP_property_level_action'),$savelang);


}

?>