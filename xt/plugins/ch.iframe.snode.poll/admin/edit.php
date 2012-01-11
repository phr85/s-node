<?php

$id =  XT::getValue("id");

/* Get main Poll Data and save it in the poll array.*/
$result = XT::query("SELECT * FROM " . XT::getTable("poll") . " WHERE id = " . $id,__FILE__,__LINE__);
$rset = XT::getQueryData($result);
$data['poll'] = $rset[0];

/* Get answers data and save it into the answers array. */
$result = XT::query("SELECT * FROM " . XT::getTable("answers") . " WHERE poll_id = " . $id ." ORDER BY position" ,__FILE__,__LINE__);
$rset = XT::getQueryData($result);
$data['answers'] = $rset;

if(XT::getPermission('edit')){
	/* Save Poll */ 
	XT::addImageButton("Save","savePoll","default","disk_blue.png","0","slave1");
	XT::addImageButton("Save and close","savePollAndClose","default","save_close.png","0","slave1");
	
    /* Save Answers *//*
	XT::addImageButton("Save answers","saveAnswer","poll","disk_blue.png","0","slave1");
	XT::addImageButton("Save and close answers","saveAnswerAndClose","poll","save_close.png","0","slave1");
	*/
    
	/* Add answer */
    XT::addImageButton('Add Answer', 'addAnswer', 'poll',"document_new.png","0","","o");
}

// By standard enabled buttons //
XT::assign('BUTTONS_POLL',$GLOBALS['plugin']->getButtons('default'));

// Buttons to save answers //
XT::assign('BUTTONS_POLL_OPTIONS',$GLOBALS['plugin']->getButtons('poll'));

XT::assign("ERRORS", XT::getActionStopped());
XT::assign("DATA",$data);

// Images

XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));

$content = XT::build('edit.tpl');

?>