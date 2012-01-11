<?php
if($GLOBALS['plugin']->getValue('id') && XT::getPermission('edit')){

    // Labels
    $GLOBALS['tpl']->assign("LABEL_USEREDIT", $GLOBALS['lang']->msg("Edit user"));
    $GLOBALS['tpl']->assign("LABEL_USERNAME", $GLOBALS['lang']->msg("Username"));
    $GLOBALS['tpl']->assign("LABEL_PASSWORD", $GLOBALS['lang']->msg("Password"));
    $GLOBALS['tpl']->assign("LABEL_SUBMIT", $GLOBALS['lang']->msg("Save"));
    $GLOBALS['tpl']->assign("LABEL_REPEATPASSWORD", $GLOBALS['lang']->msg("Repeat password"));

    XT::assign("USER_ID", $GLOBALS['plugin']->getValue('id'));

    // execute query and check for errors
    $result = XT::query("SELECT * FROM " . $GLOBALS['plugin']->getTable("user") . " WHERE id = " . $GLOBALS['plugin']->getValue('id') . "",__FILE__,__LINE__);

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

        // Date short
        $fields['date_short']['label'] = $GLOBALS['lang']->msg("Date short");
        $fields['date_short']['value'] = $row['date_short'];
        $fields['date_short']['size'] = 25;
        $fields['date_short']['type'] = 'inputtext';

        // Date long
        $fields['date_long']['label'] = $GLOBALS['lang']->msg("Date long");
        $fields['date_long']['value'] = $row['date_long'];
        $fields['date_long']['size'] = 25;
        $fields['date_long']['type'] = 'inputtext';

        // First name
        $fields['firstName']['label'] = $GLOBALS['lang']->msg("First name");
        $fields['firstName']['value'] = $row['firstName'];
        $fields['firstName']['size'] = 25;
        $fields['firstName']['type'] = 'inputtext';

        // Last name
        $fields['lastName']['label'] = $GLOBALS['lang']->msg("Last name");
        $fields['lastName']['value'] = $row['lastName'];
        $fields['lastName']['size'] = 25;
        $fields['lastName']['type'] = 'inputtext';

        // Street
        $fields['street']['label'] = $GLOBALS['lang']->msg("Street");
        $fields['street']['value'] = $row['street'];
        $fields['street']['size'] = 25;
        $fields['street']['type'] = 'inputtext';

        // City code
        $fields['plz']['label'] = $GLOBALS['lang']->msg("City code");
        $fields['plz']['value'] = $row['plz'];
        $fields['plz']['size'] = 5;
        $fields['plz']['type'] = 'inputtext';

        // City
        $fields['city']['label'] = $GLOBALS['lang']->msg("City");
        $fields['city']['value'] = $row['city'];
        $fields['city']['size'] = 25;
        $fields['city']['type'] = 'inputtext';

        // Tel
        $fields['tel']['label'] = $GLOBALS['lang']->msg("Telephone");
        $fields['tel']['value'] = $row['tel'];
        $fields['tel']['size'] = 25;
        $fields['tel']['type'] = 'inputtext';

        // Facsimile
        $fields['facsimile']['label'] = $GLOBALS['lang']->msg("Facsimile");
        $fields['facsimile']['value'] = $row['facsimile'];
        $fields['facsimile']['size'] = 25;
        $fields['facsimile']['type'] = 'inputtext';

        // Description
        $fields['description']['label'] = $GLOBALS['lang']->msg("Description");
        $fields['description']['value'] = trim($row['description']);
        $fields['description']['cols'] = 40;
        $fields['description']['rows'] = 5;
        $fields['description']['type'] = 'inputarea';

        XT::assign("IMAGE", $row['image']);
        if($row['image_version'] != ''){
            XT::assign("IMAGE_VERSION", '_' . $row['image_version']);
        }
    }

    XT::assign("USER", $fields);
    XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
    XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));

    $content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'edit.tpl');
} else {
    $GLOBALS['error_msg'] = "No User ID set.";
}
?>
