<?php

/* Get main FAQ Data and save it in the FAQ array.*/
$result = XT::query("SELECT * FROM " . XT::getTable("faq_tree_details") . " WHERE node_id = " . XT::autoval("node_id") . " and lang='" . $GLOBALS['plugin']->getActiveLang() . "'",__FILE__,__LINE__);
$rset = XT::getQueryData($result);
$data['faq'] = $rset[0];

if(XT::getPermission('edit')){
	/* Save FAQ */ 
	XT::addImageButton("Save category","saveFaqCat","faq_cat","disk_blue.png","0","slave1");
	XT::addImageButton("Save category and close","saveFaqCatAndClose","faq_cat","save_close.png","0","slave1");
	
    
    /* Save Answers *//*
	XT::addImageButton("Save answers","saveAnswer","poll","disk_blue.png","0","slave1");
	XT::addImageButton("Save and close answers","saveAnswerAndClose","poll","save_close.png","0","slave1");
	*/
    
	/* Add answer */
    /*XT::addImageButton('Add Answer', 'addAnswer', 'poll',"document_new.png","0","","o");*/
}

// Buttons to save answers //
XT::assign("xt" . XT::getBaseID() . "_BUTTONS_FAQ_CAT",$GLOBALS['plugin']->getButtons('faq_cat'));



XT::assign("xt" . XT::getBaseID() . "_ERRORS", XT::getActionStopped());
XT::assign("xt" . XT::getBaseID() . "_DATA",$data);

// Images
XT::assign("xt" . XT::getBaseID() . "_IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
XT::assign("xt" . XT::getBaseID() . "_IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build('edit_cat.tpl');

?>