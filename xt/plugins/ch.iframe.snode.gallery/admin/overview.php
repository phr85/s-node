<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

// Attribute :: Open gallery
XT::setSessionValue('open',XT::getValue("open") != '' ? XT::getValue("open") : XT::getSessionValue('open'));

// Set used values
$open = XT::getSessionValue("open");

// Get all galleries
require_once(CLASS_DIR . 'gallery.class.php');
$gallery = new XT_Gallery();
$count = $gallery->getGalleries($open);

// Add Buttons
if(XT::getPermission('browserStructure')){
    if(XT::getSessionValue('ctrl_add') || XT::getSessionValue('ctrl_cut') || XT::getSessionValue('ctrl_copy')){
        XT::addImageButton('Cancel','ctrlCancel','default','delete.png','1','master');
    } else {
        (sizeof($count) > 0) ? XT::addImageButton('Add gallery','addNode','default','photo_portrait.png','1','master') : XT::addImageButton('Add gallery','addFirstNode','default','photo_portrait.png','1','master');
    }
}

XT::assign("CTRL", XT::getSessionValue('ctrl_add') | XT::getSessionValue('ctrl_cut') | XT::getSessionValue('ctrl_copy'));

// Define ctrl mode
XT::assign("OPEN", $open);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build('overview.tpl');

?>