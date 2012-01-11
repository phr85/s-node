<?php
$form = $_GET['form'] == "" ? XT::getSessionValue("form") : $_GET['form'];
$field = $_GET['field'] == "" ? XT::getSessionValue("field") : $_GET['field'];
$titlefield = $_GET['titlefield'] == "" ? XT::getSessionValue("titlefield") : $_GET['titlefield'];

XT::setSessionValue("form", $form);
XT::setSessionValue("field", $field);
XT::setSessionValue("titlefield", $titlefield);

XT::assign('FORM', $form);
XT::assign('FIELD', $field);
XT::assign('TITLEFIELD', $titlefield);

// Attribute :: Open gallery
XT::setSessionValue('open',XT::getValue("open") != '' ? XT::getValue("open") : XT::getSessionValue('open'));

// Set used values
$open = XT::getSessionValue("open");

// Get all galleries
require_once(CLASS_DIR . 'gallery.class.php');
$gallery = new XT_Gallery();
$count = $gallery->getGalleries($open);

/* Add Buttons
if(XT::getPermission('browserStructure')){
    if(XT::getSessionValue('ctrl_add') || XT::getSessionValue('ctrl_cut') || XT::getSessionValue('ctrl_copy')){
        XT::addImageButton('Cancel','ctrlCancel','default','delete.png','1','master');
    } else {
        (sizeof($count) > 0) ? XT::addImageButton('Add gallery','addNode','default','photo_portrait.png','1','master') : XT::addImageButton('Add gallery','addFirstNode','default','photo_portrait.png','1','master');
    }
}*/

XT::assign("CTRL", XT::getSessionValue('ctrl_add') | XT::getSessionValue('ctrl_cut') | XT::getSessionValue('ctrl_copy'));

// Define ctrl mode
XT::assign("OPEN", $open);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build('overview.tpl');

?>