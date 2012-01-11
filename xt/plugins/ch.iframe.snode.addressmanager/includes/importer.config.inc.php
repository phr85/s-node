<?php
/* config file for importer
Note: Locale setting is taken into account by this action.
If LANG is e.g. en_US.UTF-8, files in one-byte encoding are read wrong by this action.
*/


// FILE Settings
// -------------

$addrimportcfg['ignore_first_line'] = true;
$addrimportcfg['max_num_of_coulumn_in_source_file'] = 20;
// Set the field delimiter (one character only). Defaults as a comma.
$addrimportcfg['delimiter'] = ",";
// Set the field enclosure character (one character only). Defaults as a double quotation mark.
$addrimportcfg['enclosure'] = '"';
$addrimportcfg['escape_character'] = '\\';



// IMPORT Settings
// -------------

// If you have a unique identifier in the source data, i.e. addrID , you can use it here.
// without modifiere addresses will be added
$addrimportcfg['identifier_coulumn'] = 2;
$addrimportcfg['snode_identifier_coulumn'] = false;

$addrimportcfg['data']['field']['coulumn'] = false;

// DATA Settings
// -------------

// Status (1 = Aktiv, 0 = Inaktiv)
$addrimportcfg['data']['setState'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Title
$addrimportcfg['data']['setTitle'] = array(
                                        'enabled' => true,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => 'XT_addressmanager_build_title');
// Anrede
$addrimportcfg['data']['setGender'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => true,
                                        'default_value' => 1,
                                        'callback' => false);

// Vorname
$addrimportcfg['data']['setFirstName'] = array(
                                        'enabled' => true,
                                        'coulumn' => 1,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Nachname
$addrimportcfg['data']['setLastName'] = array(
                                        'enabled' => true,
                                        'coulumn' => 0,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Firma
$addrimportcfg['data']['setCompany'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Position
$addrimportcfg['data']['setPosition'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Strasse
$addrimportcfg['data']['setStreet'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// PLZ
$addrimportcfg['data']['setPostalCode'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Ort
$addrimportcfg['data']['setCity'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Land
$addrimportcfg['data']['setCountry'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Region
$addrimportcfg['data']['setState'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Webseite
$addrimportcfg['data']['setWebsite'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Skype
$addrimportcfg['data']['setSkype'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// E-Mail
$addrimportcfg['data']['setEMail'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Telefon
$addrimportcfg['data']['setTelephone'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Mobile
$addrimportcfg['data']['setTelephoneMobile'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Fax
$addrimportcfg['data']['setFacsimile'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);

// Geburtstag
$addrimportcfg['data']['setBirthdate'] = array(
                                        'enabled' => true,
                                        'coulumn' => 3,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => 'XT_addressmanager_calculate_birthdate_from_date_string_eu');
// Beschreibung
$addrimportcfg['data']['setDescription'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);
// Öffentlich? (1/0)
$addrimportcfg['data']['setPublic'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);
// Image (ID)
$addrimportcfg['data']['setImage'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);
//Private Angaben
// E-Mail
$addrimportcfg['data']['setEMailPrivate'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);
// Telefon
$addrimportcfg['data']['setEMailPrivate'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);
// Mobil
$addrimportcfg['data']['setTelephoneMobilePrivate'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);
// Fax
$addrimportcfg['data']['setFacsimilePrivate'] = array(
                                        'enabled' => false,
                                        'coulumn' => false,
                                        'use_default_value_if_disabled' => false,
                                        'default_value' => false,
                                        'callback' => false);


function XT_addressmanager_calculate_birthdate_from_date_string_eu($data){
    $birthdateRec = explode(".", str_replace(" ","", addslashes($data['data'][$data['field']])));
    if(count($birthdateRec) == 3){
    // calculate birth date
    return mktime(1,1,1,$birthdateRec[1],$birthdateRec[0],$birthdateRec[2]);
    }else {
    	return false;
    }
}

function XT_addressmanager_calculate_birthdate_from_date_string_us($datestring){
    return  strtotime($datestring);
}

function XT_addressmanager_build_title($data){
return $data['data'][1] . " " . $data['data'][0];
}

?>