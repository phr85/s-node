<?php


// Buttons
XT::addImageButton('<u>S</u>ave','s1SaveUser','default','disk_blue.png','0','slave1','s');
XT::addImageButton('Save and <u>E</u>xit','s1SaveUserAndExit','default','save_close.png','0','slave1','e');
XT::addImageButton('E<u>x</u>it','s1UserExit','default','exit.png','0','slave1','x');


// execute query and check for errors
$result = XT::query("SELECT usr.*,
            address.id as address_id
            FROM " . XT::getTable("users") . " as usr
            LEFT JOIN " . XT::getTable("addresses") . " as address ON usr.id=address.user_id AND address.is_primary_user_address=1
            WHERE usr.id = " . XT::getValue('user_id') . "",__FILE__,__LINE__);

while($row = $result->FetchRow()){

    // Username
    $fields['username']['label'] = $GLOBALS['lang']->msg("Username");
    $fields['username']['value'] = $row['username'];
    $fields['username']['type'] = 'text';
    XT::assign("USERNAME", $row['username']);

    // Password
    $fields['password']['label'] = $GLOBALS['lang']->msg("Password");
    $fields['password']['type'] = 'inputpassword';
    $fields['password']['size'] = 25;
    //$fields['password']['error'] = @$error['password'];

    // Confirm password
    $fields['password_confirm']['label'] = $GLOBALS['lang']->msg("Confirm password");
    $fields['password_confirm']['type'] = 'inputpassword';
    $fields['password_confirm']['size'] = 25;
    //$fields['password_confirm']['error'] = @$error['password_confirm'];

    // E-Mail
    $fields['email']['label'] = $GLOBALS['lang']->msg("E-Mail");
    $fields['email']['value'] = $row['email'];
    $fields['email']['size'] = 25;
    $fields['email']['type'] = 'inputtext';

    // Language
    $fields['language']['label'] = $GLOBALS['lang']->msg("Language");
    $fields['language']['type'] = 'select';
    $fields['language']['selected'] = $row['lang'];
    $fields['language']['value'] = array('de', 'en');
    $fields['language']['value_labels'] = array('Deutsch', 'English');

    // Description
    $fields['description']['label'] = $GLOBALS['lang']->msg("Description");
    $fields['description']['value'] = trim($row['description']);
    $fields['description']['cols'] = 40;
    $fields['description']['rows'] = 5;
    $fields['description']['type'] = 'inputarea';

    XT::assign("IMAGE", $row['image']);
    XT::assign("username", $row['username']);
    XT::assign("address_id", $row['address_id']);
}

XT::assign("USER", $fields);


XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));

XT::assign("USER_ID", $GLOBALS['plugin']->getValue("user_id"));
XT::assign("PRINCIPAL_ID", $GLOBALS['plugin']->getValue("user_id"));
$content = XT::build("s1EditUser.tpl");

?>
