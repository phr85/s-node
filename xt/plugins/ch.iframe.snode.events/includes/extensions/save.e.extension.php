<?php
if (XT::getPermission("edit")) {
    XT::addImageButton('[S]ave', 'saveEvent', 'edit_buttons', 'save.png',"0","","s");
    XT::addImageButton('Save and close', 'saveEventAndClose','edit_buttons','save.png','0',"","x");
    XT::addImageButton('show [R]egistrations', 'showRegistrations', 'edit_buttons', 'users1.png',"0","","r");

XT::assign('EDIT_BUTTONS',$GLOBALS['plugin']->getButtons('edit_buttons'));
}

?>
