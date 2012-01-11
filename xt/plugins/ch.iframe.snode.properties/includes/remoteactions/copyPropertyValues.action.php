<?php
/*
 * Copy property values
 */
 
 // include tables and property types config
include(PLUGIN_DIR . "ch.iframe.snode.properties/includes/config.ext.inc.php");
 if (XT::getValue("save_lang") != ""){
     $savelang = XT::getValue("save_lang");
 }else {
     $savelang = XT::getPluginLang();
 }
 
 $content_type = XT::getValue("XT_PROP_content_type");
 $source_content_id = XT::getValue('XT_PROP_content_id');
 $target_content_id = XT::getValue('XT_PROP_target_content_id');
 
 // Gett all propertie values for the requested content_type and content_id
 $sql = "SELECT * FROM " . XT::getTable("values") . "
      WHERE
          content_id=" .  $source_content_id  . "
      AND
          lang='" . $savelang . "'
      AND
          content_type=" . $content_type;
 $copy_prop_result = XT::query($sql,__FILE__,__LINE__);
 
 while($copy_prop_row = $copy_prop_result->FetchRow()){
 	// Reset the arrays for fieldnames and data
 	$fieldnames = array();
 	$values = array();
 	
 	// get fieldnames and values without  the content id because it's new generated
 	foreach ($copy_prop_row as $key => $value) {
 		if ( $key != "content_id") {
 			$fieldnames[] = $key;
 			$values[] = $value;
 		}
 	}
 	// Generate the whole insert statement
 	$sql = "INSERT INTO " . XT::getTable("values") . " (content_id," . implode(",",$fieldnames) . ") VALUES ('" . $target_content_id . "','" . implode("','",$values)  . "')";
 	XT::query($sql,__FILE__,__LINE__);
 }
?>
