<?php

// Check if everything was entered.
$faq_title = XT::getValue('title');

if($faq_title == ""){
   		XT::log(XT::translate("Please fill in the category title"),__FILE__,__LINE__,XT_ERROR);
}

$id = XT::getValue("cat_id");

// perform Faq save operation
XT::query("
    UPDATE
        " . XT::getTable('faq_tree_details') . "
    SET
        title = '" . XT::getValue('title') . "',
        description = '" . XT::getValue('description') . "',
        public = '" . XT::getValue('public') . "'
    WHERE
        node_id = '" . $id . "'
    AND
        
        lang = '" . XT::getValue('save_lang') . "'"
,__FILE__,__LINE__);

XT::setValue('node_id',$id);
XT::setAdminModule("edit_cat");

?>