<?php


$entry_in_lang_exist = XT::getQueryData(XT::query("SELECT count(id) as cnt from " . XT::getTable('faq') . " WHERE  id = '" . XT::getValue('id') . "'
    AND
        lang = '" . XT::getActiveLang() . "'" ));
if($entry_in_lang_exist[0]['cnt']==0){
	XT::query("
    INSERT into
        " . XT::getTable('faq') . "
    SET
        title = '" . XT::getValue('title') . "',
        date = " . TIME . ",
        description = '" . XT::getValue('description') . "',
        questioner_mail = '" . XT::getValue('questioner_mail') . "',
        answer = '" . XT::getValue('answer') . "',
        answer_title = '" . XT::getValue('answer_title') . "',
        answer_name = '" . XT::getValue('answer_name') . "',
        answer_address = '" . XT::getValue('answer_address') . "',
        mod_date = " . time() . ",
        mod_user = " . XT::getUserID() . ",
        image = '" . XT::getValue('image') . "',
        image_version = '" . XT::getValue('image_version') . "',
        image_zoom = '" . $image_zoom . "',
        lang = '" . XT::getActiveLang() . "',
        id = '" . XT::getValue('id') . "'"
,__FILE__,__LINE__);
}


/* Get main FAQ Data and save it in the FAQ array.*/
$result = XT::query("SELECT * FROM " . XT::getTable("faq") . " WHERE id = " . XT::getValue("id") . " and lang='" . $GLOBALS['plugin']->getActiveLang() . "'",__FILE__,__LINE__);
$rset = XT::getQueryData($result);
$data['faq'] = $rset[0];





$answered = $data['faq']['is_answered'];

if(XT::getPermission('edit')){
	/* Save FAQ */
	XT::addImageButton("Save","saveFaq","default","disk_blue.png","0","slave1");
	XT::addImageButton("Save and close","saveFaqAndClose","default","save_close.png","0","slave1");
}

// Select which Address is to use as answer address
$mailaddresses = array();

// Get Default System Mail Address
$mailaddresses[0] = $GLOBALS['cfg']->get('smtp','DefaultFrom');

// Get Plugin Config Mail Addresses
$i = 1;
foreach ($GLOBALS['plugin']->getConfig("answeraddresses") as $key){
	$mailaddresses[$i] = $key;
	$i++;
}
// Assign mail addresses to the data array.
$data['answeraddresses'] = $mailaddresses;

// By standart enabled buttons
XT::assign("xt" . XT::getBaseID() . "_BUTTONS_FAQ",$GLOBALS['plugin']->getButtons('default'));

// Assign if Question was already answered
XT::assign("xt" . XT::getBaseID() . "_selected", $answered);


XT::assign("xt" . XT::getBaseID() . "_ERRORS", XT::getActionStopped());
XT::assign("xt" . XT::getBaseID() . "_DATA",$data);

// Images
XT::assign("xt" . XT::getBaseID() . "_IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
XT::assign("xt" . XT::getBaseID() . "_IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());
$content = XT::build('edit.tpl');
?>