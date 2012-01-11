<?php
// Achtung, die seltsamen variablennamen sind nur dazu da das es keine überschneidungen gibt zu den aufgerufenen actions
// include tables and property types config
include_once(PLUGIN_DIR . "ch.iframe.snode.properties/includes/config.ext.inc.php");
// get properties
$propgrpprops = XT::getQueryData(XT::query("SELECT property_id from " . XT::getTable("prop2group") . " WHERE group_id=" . XT::getValue("XT_PROP_propertygroup_id")));

// add properties
foreach ($propgrpprops as $propgrppropid) {
    // check if property is already added
    $cnt = XT::getQueryData(XT::query("SELECT count(*) as cnt FROM  " . XT::getTable('values') . " WHERE
    `property_id`= " . $propgrppropid['property_id'] . " AND
    `content_type`= " . XT::getValue("XT_PROP_content_type") . " AND
    `content_id`= " . XT::getValue("XT_PROP_content_id") . " AND
    `content_sub_id`= " . XT::getValue("XT_PROP_content_sub_id") * 1 . " AND
    `lang`='" . XT::getPluginLang() . "'",__FILE__,__LINE__));
    if($cnt[0]['cnt'] < 1){
        XT::setValue("XT_PROP_property_id",$propgrppropid['property_id']);
        XT::call("ch.iframe.snode.properties.addPropertyToContentID");
    }
}
?>