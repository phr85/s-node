<?php

// Image Zoom enabled?
if(XT::getValue("image_zoom")==1){
    $image_zoom = 1;
}else{
    $image_zoom = 0;
}

// Convert date format: dd.mm.yy into unix timestamp
if(XT::getValue('faqdate_str')!=""){
    $date_pre = explode(".",XT::getValue('faqdate_str'));
    $faqdate = mktime(0,0,0,$date_pre[1],$date_pre[0],$date_pre[2]);
}else{
    $faqdate = 'NULL';
}

// Check if everything was entered.
$faq_title = XT::getValue('title');

if($faq_title == ""){
   		XT::actionStop(XT::translate("Please fill in the faq title"));
}

// perform Faq save operation
XT::query("
    UPDATE
        " . XT::getTable('faq') . "
    SET
        title = '" . XT::getValue('title') . "',
        date = " . $faqdate . ",
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
        image_zoom = '" . $image_zoom . "'
    WHERE
        id = '" . XT::getValue('id') . "'
    AND
        lang = '" . XT::getValue('save_lang') . "'"
,__FILE__,__LINE__);



// Instantiate indexing object and index main fields
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex(XT::getValue('id'),XT::getContentType("FAQ Article"), 1);
$search->setLang(XT::getActiveLang());

if(XT::getValue("active")) {
    $search->enable();
}
else {
    $search->disable();
}

$search->add(addslashes(XT::getValue('title')), 4);
$search->add(addslashes(XT::getValue('description')), 3);
$search->add(addslashes(XT::getValue('answer_title')), 2);
$search->add(addslashes(XT::getValue('answer')), 1);

$searchimage = XT::getValue('image') != "" ? XT::getValue('image') : 0;

$search->build(addslashes(XT::getValue('title')), addslashes(XT::getValue('description')),$searchimage);

?>