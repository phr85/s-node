<?php

/* Feldtypen */
$fieldtypes = array(
    0 => array(
        'description' => 'emptyline',
        'template' => '',
        'dummy_label' => 0,
    ),
    1 => array(
        'description' => 'seperator',
        'template' => '',
        'dummy_label' => 0,
    ),
    2 => array(
        'description' => 'single line text',
        'template' => 'input_text.tpl',
        'dummy_label' => 0,
    ),
    3 => array(
        'description' => 'multi line text',
        'template' => 'textarea.tpl',
        'dummy_label' => 0,
    ),
    4 => array(
        'description' => 'select simple',
        'template' => 'select.tpl',
        'dummy_label' => 0,
    ),
    5 => array(
        'description' => 'select multiple',
        'template' => 'select_multiple.tpl',
        'dummy_label' => 0,
    ),
    6 => array(
        'description' => 'radio',
        'template' => 'input_radio.tpl',
        'dummy_label' => 1,
    ),
    7 => array(
        'description' => 'checkbox',
        'template' => 'input_checkbox.tpl',
        'dummy_label' => 1,
    ),
    8 => array(
        'description' => 'file upload',
        'template' => 'input_file.tpl',
        'dummy_label' => 0,
    ),
    9 => array(
        'description' => 'datepicker',
        'template' => 'datepicker.tpl',
        'dummy_label' => 0,
    ),
    10 => array(
        'description' => 'captcha',
        'template' => 'captcha.tpl',
        'dummy_label' => 0,
    ),
);
/* EOF Feldtypen */


/* Callback Funktionen */
function application_check_email ($input) {
    return(XT::checkEmail($input));
}

function application_check_date ($input) {
    if(preg_match("/\A\d{2}\.\d{2}\.\d{4}\Z/", $input, $matches)) {
        return(true);
    }
    else {
        return(false);
    }
}

function application_check_captcha ($input) {
    if(md5($input) == $_SESSION['application_captcha']) {
        return(true);
    }
    else {
        return(false);
    }
}
/* EOF Callback Funktionen */


/* Schema */

/**
 * Group Example:
 *
 *   array(
 *       'fields' => array(
 *           array (
 *              'label' => '',
 *              'dont_display_label' => 0,
 *              'dont_save' => 0,
 *              'type' => 0,
 *              'default' => '',
 *              'size' => 10,
 *              'cols' => 35,
 *              'rows' => 5,
 *              'required' => 1,
 *              'callback_func' => '',
 *              'values' => array(
 *                  array(
 *                      'label' => '',
 *                      'value' => '',
 *                  ),
 *               ),
 *           ),
 *       ),
 *   ),
 *
 */

$schematic['title'] = "application_form";
$schematic['field_groups'] = array (
    array(
        'fields' => array(
            array (
                'label' => 'personal_data',
                'type' => 1,
                'dont_save' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'title',
                'type' => 6,
                'values' => array(
                    array(
                        'value' => XT::translate('mr.'),
                        'label' => XT::translate('mr.'),
                    ),
                    array(
                        'value' => XT::translate('mrs.'),
                        'label' => XT::translate('mrs.'),
                    ),
                ),
                'required' => 1,
            ),
        ),
    ),
    // Dieses Feld muss irgendwo stehen, da der Wert im Adminbereich verwendet wird
    array(
        'fields' => array(
            array (
                'label' => 'first_name',
                'type' => 2,
                'required' => 1,
            ),
        ),
    ),
    // Dieses Feld muss irgendwo stehen, da der Wert im Adminbereich verwendet wird
    array(
        'fields' => array(
            array (
                'label' => 'last_name',
                'type' => 2,
                'required' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'street',
                'type' => 2,
                'size' => 13,
                'required' => 1,
            ),
            array (
                'label' => 'house',
                'type' => 2,
                'size' => 3,
                'required' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'postal_code',
                'type' => 2,
                'size' => 4,
                'required' => 1,
            ),
            array (
                'label' => 'city',
                'type' => 2,
                'size' => 12,
                'required' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'country',
                'type' => 2,
                'required' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'nationality',
                'type' => 2,
                'required' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'tel',
                'type' => 2,
                'required' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'fax',
                'type' => 2,
            ),
        ),
    ),
    // Dieses Feld wird fuer eine allfaellige Kopie benoetigt!!!!
    array(
        'fields' => array(
            array (
                'label' => 'email',
                'type' => 2,
                'required' => 1,
                'callback_func' => 'application_check_email',
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'website',
                'type' => 2,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'birthdate',
                'type' => 9,
                'required' => 1,
                'callback_func' => 'application_check_date',
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'civil_status',
                'type' => 6,
                'values' => array(
                    array(
                        'value' => XT::translate('unmarried'),
                        'label' => XT::translate('unmarried'),
                    ),
                    array(
                        'value' => XT::translate('married'),
                        'label' => XT::translate('married'),
                    ),
                    array(
                        'value' => XT::translate('divorced'),
                        'label' => XT::translate('divorced'),
                    ),
                ),
                'required' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'application_data',
                'type' => 1,
                'dont_save' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'focus',
                'type' => 2,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'application_text',
                'type' => 3,
                'cols' => 40,
                'rows' => 20,
                'required' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'desired_contact_data',
                'type' => 1,
                'dont_save' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'desired_tel',
                'type' => 2,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'desired_tel_mobile',
                'type' => 2,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'desired_email',
                'type' => 2,
                'callback_func' => 'application_check_email',
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'more_informations',
                'type' => 1,
                'dont_save' => 1,
            ),
        ),
    ),
    // Falls dieses Feld gewuenscht wird, darauf achten, dass es copy heisst!!!
    array(
        'fields' => array(
            array (
                'label' => 'copy',
                'dont_display_label' => 1,
                'dont_save' => 1,
                'default' => 1,
                'type' => 7,
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => XT::translate('Do you dlike to get a copy of the application?'),
                    ),
                ),
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'pp',
                'dont_display_label' => 1,
                'dont_save' => 1,
                'type' => 7,
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => XT::translate('Do you accept the PP?'),
                    ),
                ),
                'required' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'attachments',
                'type' => 1,
                'dont_save' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'files',
                'dont_display_label' => 1,
                'type' => 8,
                'dont_save' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'spam_check',
                'type' => 1,
                'dont_save' => 1,
            ),
        ),
    ),
    array(
        'fields' => array(
            array (
                'label' => 'captcha',
                'dont_display_label' => 1,
                'dont_save' => 1,
                'type' => 10,
                'callback_func' => 'application_check_captcha',
                'required' => 1,
            ),
        ),
    ),
);
/* EOF Schema */

?>