<?php

// Add buttons
XT::addImageButton('Save','saveNewsletter','default','disk_blue.png','0','slave1','s');

XT::addImageButton('Test run','sendTestNewsletter','default','warning.png','0','slave1','s');
if (XT::getConfig("batched_mode") == true) {
	XT::addImageButton('Send','prepareBatchedSending','send','mail.png','0','slave1');
} else {
	XT::addImageButton('Send','sendNewsletter','send','mail.png','0','slave1');
}
XT::assign("SEND_BUTTONS", $GLOBALS['plugin']->getButtons('send'));

XT::addImageButton('Save','saveNewsletter','second','disk_blue.png','0','slave1','s');

// Get newsletter id
$newsletter_id = XT::getValue('newsletter_id') > 0 ? XT::getValue('newsletter_id') : 0;
$newsletter_id > 0 ? XT::setSessionValue('newsletter_id',$newsletter_id) : $newsletter_id = XT::getSessionValue('newsletter_id');

if($newsletter_id > 0){
    
    // Get newsletter details
    $result = XT::query("
        SELECT
            a.id,
            a.title,
            a.description,
            a.content_html,
            a.content_plain,
            a.header,
            a.header_plain,
            a.footer,
            a.footer_plain,
            a.template,
            a.sender_email,
            a.sender_name,
            a.sent_date,
            a.image,
            a.image_version,
			a.lang
            
        FROM
            " . XT::getTable("newsletter")  . " as a
        WHERE
            id = " . $newsletter_id . "
    ",__FILE__,__LINE__);
    
    $newsletter = array();
    while($row = $result->FetchRow()){
        $newsletter = $row;
    }
    XT::assign("NEWSLETTER", $newsletter);
        
    $result = XT::query("SELECT * from " . XT::getTable("newsletter_chapters") . " WHERE id = " . $newsletter_id . " ORDER by level ASC",__FILE__,__LINE__);
    $chapters = XT::getQueryData($result);
    
    XT::assign("CHAPTERS", $chapters);
    
    
    $maxlevel = XT::getQueryData(XT::query("SELECT count(*) as maxlevel from " . XT::getTable("newsletter_chapters") . " WHERE id = " . $newsletter_id ,__FILE__,__LINE__));
    
    XT::assign("MAXLEVEL", $maxlevel[0]['maxlevel']);

    
    // Get categories
    $result = XT::query("SELECT n.id, n.title, floor(nc.category_id / n.id) as selected 
    FROM " . XT::getTable("newsletter_categories") . " as n 
    left join " . XT::getTable("newsletter_newsl2cat") . " as nc on (nc.category_id = n.id AND nc.newsletter_id=" . $newsletter_id . ") 
    ORDER BY n.title ASC",__FILE__,__LINE__);
    
    XT::assign("CATEGORIES", XT::getQueryData($result));
    
} else {
    
    // Show error message
    XT::log("Newsletter ID is not set",__FILE__,__LINE__,XT_ERROR);
    
}

// Get Registration Templates
$templates = array();

// Get all default Templates
foreach (glob(TEMPLATE_DIR . '/default/ch.iframe.snode.newsletter/mail/*.tpl') as $registertpl){
    $templates[substr($registertpl, strrpos($registertpl, "/")+1)]  = substr($registertpl, strrpos($registertpl, "/")+1);
}

// Get all themed Templates
foreach (glob(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.newsletter/mail/*.tpl') as $registertpl){
    $templates[substr($registertpl, strrpos($registertpl, "/")+1)]  = substr($registertpl, strrpos($registertpl, "/")+1);
}

XT::assign("TEMPLATES",  $templates);

XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("SECOND_BUTTONS", $GLOBALS['plugin']->getButtons('second'));

$content = XT::build('edit.tpl');

?>
