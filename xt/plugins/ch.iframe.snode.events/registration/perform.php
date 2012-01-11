<?php

// Config laden
include(PLUGIN_DIR . 'ch.iframe.snode.events/includes/registration.config.inc.php');

// Adressklasse laden
XT::loadClass('address.class.php','ch.iframe.snode.addressmanager');

// PHP Mailer laden
XT::loadClass('phpmailer/class.phpmailer.php');

// Alle Fehler hier speichern
$errors = array();

// Felder pruefen
$tocheck = XT::getConfig("tocheck");
if(is_array($tocheck['empty'])) {
    foreach($tocheck['empty'] as $fieldname => $errormessage) {
        if(empty($register[$fieldname])) {
            $errors[$fieldname] = $errormessage;
        }
    }
}
if(is_array($tocheck['callback'])) {
    foreach($tocheck['callback'] as $fieldname => $values) {
        if(!call_user_func($values['function'], $register[$fieldname])) {
            $errors[$fieldname] = $values['message'];
        }
    }
}

// Pruefen ob es noch genuegend Plaetze gibt
if(isset($data['data']['freeplaces']) && $data['data']['freeplaces'] < (count($register['acco_pers'])+1)) {
    $errors['freeplaces'] = "There are less places than you wish";
}

// Die ID einer allenfalls bestehenen Adresse abrufen
$address_id = intval(XT_Address::findBestAddress($register));

if($address_id > 0) {
    
    // Pruefen ob sich Person bereits registriert hat
    $result = XT::query("
        SELECT
            event_id
        FROM
            " . XT::getTable("events_registrations") . "
        WHERE
            event_id = " . $event_id . " AND
            address_id = " . $address_id . "
        LIMIT 1
    ",__FILE__,__LINE__);

    $res = XT::getQueryData($result);

    if($res[0]['event_id'] != "") {
        $errors['allreadyregistred'] = "You are allready registred";
    }
    
}

// Falls keine Fehler vorhanden sind mit der Verarbeitung fortfahren
if(count($errors) == 0) {
    
    // Nur neue Adressen speichern aus Sicherheitsgruenden
    if($address_id == 0) {
        
        // Adressobjekt erstellen
        $address = new XT_Address();
        
        // Die Werte der Adresse zuweisen
        $address->setTitle(trim($register['lastName']) . " " . trim($register['firstName']));
        $address->setCompany(trim($register['company']));
        $address->setGender(intval($register['gender']));
        $address->setFirstName(trim($register['firstName']));
        $address->setLastName(trim($register['lastName']));
        $address->setStreet(trim($register['street']) . " " . trim($register['street_nr']));
        $address->setPostalCode(trim($register['postalCode']));
        $address->setCity(trim($register['city']));
        $address->setEMail(trim($register['email']));
        $address->setTelephone(trim($register['tel']));
        $address->setActive(1);
        
        if(!empty($register['tel_mobile'])) {
            $address->setTelephoneMobile(trim($register['tel_mobile']));
        }
        
        // Den Adresstyp auf 3 setzen falls keiner vorhanden ist
        if(intval($registerconfig['usertype']) > 0) {
            $address->setType($registerconfig['usertype']);
        }
        else {
            $address->setType(3);
        }
        
        // Adresse speichern
        $address->save();
        
        // Adressid abrufen
        $address_id = intval(XT_Address::findBestAddress($register));
    }
        
    // Die Eventanmeldung eintragen
     XT::query("
        INSERT INTO " . XT::getTable("events_registrations") . " (
            event_id,
            address_id
        ) VALUES (
            " . $event_id . ",
            " . $address_id . "
        )
    ",__FILE__,__LINE__);
    
    // Die Eventdetails eintragen
    foreach($register as $key => $value) {
        
        // Bei den Begleitpersonen diesen Part durchlaufen
        if($key != "acco_pers") {
            
            // Die Anrede bestimmen
            if($key == "gender") {
                if($value == 2) {
                    $value = "mrs";
                }
                else {
                    $value = "mr";
                }
            }
            
            if(!is_array($value)) {
                XT::query("
                    INSERT INTO " . XT::getTable("events_registrations_details") . " (
                        event_id,
                        address_id,
                        fieldname,
                        fieldvalue,
                        person_nr
                    ) VALUES (
                        " . $event_id . ",
                        " . $address_id . ",
                        '" . $key . "',
                        '" . $value . "',
                        0
                    )
                ",__FILE__,__LINE__);
            }
            else {
                XT::query("
                    INSERT INTO " . XT::getTable("events_registrations_details") . " (
                        event_id,
                        address_id,
                        fieldname,
                        fieldvalue,
                        person_nr
                    ) VALUES (
                        " . $event_id . ",
                        " . $address_id . ",
                        '" . $key . "',
                        '" . implode(", ", $value) . "',
                        0
                    )
                ",__FILE__,__LINE__);
            }
            
        }
        else {
            foreach($register[$key] as $subkey => $person) {
                
                // Die Anrede bestimmen
                if($person["gender"] == 2) {
                    $person["gender"] = "mrs";
                }
                else {
                    $person["gender"] = "mr";
                }
                
                foreach($person as $personfieldkey => $personfieldvalue) {
                 
                    XT::query("
                        INSERT INTO " . XT::getTable("events_registrations_details") . " (
                            event_id,
                            address_id,
                            fieldname,
                            fieldvalue,
                            person_nr
                        ) VALUES (
                            " . $event_id . ",
                            " . $address_id . ",
                            '" . $personfieldkey . "',
                            '" . $personfieldvalue . "',
                            '" . $subkey . "'
                        )
                    ",__FILE__,__LINE__);   
                    
                }
            }
        }
    }

    // Die Zahl der registrierten Personen erhoehen
    XT::query("
        UPDATE
            " . XT::getTable("events") . "
        SET
            reg_visitors = (reg_visitors + " . (count($register['acco_pers'])+1) . ")
        WHERE
            id = " . $event_id . "
        LIMIT 1
    ",__FILE__,__LINE__);
    
    // Den Eventtitel abrufen
    $result = XT::query("
        SELECT
            title
        FROM
            " . XT::getTable("events_details") . "
        WHERE
            id = " . $event_id . " AND
            lang = '" . XT::getLang() . "'
        LIMIT 1
    ",__FILE__,__LINE__);

    $res = XT::getQueryData($result);
    
    // Mail Daten zusammenstellen
    $maildata['eventtitle'] = $res[0]['title'];
    
    foreach($register as $key => $value) {
                
        if($key != "acco_pers") {
            
            // Die Anrede bestimmen
            if($key == "gender") {
                if($value == 2) {
                    $value = "mrs";
                }
                else {
                    $value = "mr";
                }
            }
            
            if(!is_array($value)) {
                $maildata[$key] = $value;
            }
            else {
                $maildata[$key] = implode(", ", $value);
            }
            
        }
        else {
            foreach($register['acco_pers'] as $perskey => $person) {
                
                // Die Anrede in "menschenlesbare" Form bringen
                if($person["gender"] == 2) {
                    $person["gender"] = "mrs";
                }
                else {
                    $person["gender"] = "mr";
                }
                
                foreach($person as $fieldkey => $fieldvalue) {
                    if($fieldkey == "gender") {
                        $maildata['acco_pers' . $perskey] .= XT::translate($fieldkey) . ": " . XT::translate($fieldvalue) . "\n";
                    }
                    else { 
                        $maildata['acco_pers' . $perskey] .= XT::translate($fieldkey) . ": " . $fieldvalue . "\n";
                    }
                }
            }
        }
    }
    
    XT::assign("xt" . XT::getBaseID() . "_registration_mail", $maildata);
    
    // Kontaktperson abrufen
    $result = XT::query("
        SELECT
            contact_person_id
        FROM
            " . XT::getTable("events") . "
        WHERE
            id = " . $event_id . "
        LIMIT 1
    ",__FILE__,__LINE__);

    $res = XT::getQueryData($result);
    
    if($res[0]['contact_person_id'] != "") {
        $contactaddress = new XT_Address($res[0]['contact_person_id']);
        $contactemail = trim($contactaddress->getEmail());
    }
    
    // Veranstaltungsort abrufen
    $result = XT::query("
        SELECT
            address
        FROM
            " . XT::getTable("events") . "
        WHERE
            id = " . $event_id . "
        LIMIT 1
    ",__FILE__,__LINE__);

    $res = XT::getQueryData($result);
    
    if($res[0]['address'] != "") {
        $eventaddress = new XT_Address($res[0]['address']);
        $eventemail = trim($eventaddress->getEmail());
    }
    
    // Mail versenden
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->IsHTML(true);
    $mail->Encoding = '7bit';
    $mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
    $mail->FromName = $GLOBALS['cfg']->get("system","email");
    $mail->From = $GLOBALS['cfg']->get("system","email");
    $mail->Host = $GLOBALS['cfg']->get('smtp','Host');
    $mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
    if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
        $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
        $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
    }
    $mail->AddAddress(trim($register['email']));
    
    foreach($registerconfig['receivers'] as $receiver) {
        // Mail an Kontaktperson
        if($receiver == 1 && XT::checkEmail(trim($contactemail))) {
            $mail->AddCC(trim($contactemail));
        }
        // Mail an Eventemail
        elseif($receiver == 2 && XT::checkEmail(trim($eventemail))) {
            $mail->AddCC(trim($eventemail));
        }
        // Mail an gewuenschte E-Mail Adresse
        elseif (XT::checkEmail(trim($receiver))) {
            $mail->AddCC(trim($receiver));
        }
    }
    
    $mail->Subject  = $GLOBALS['cfg']->get("system","name") . ' - ' . $maildata['eventtitle'];
    $mail->Body  = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'mail/' . $style);
    if(!$mail->Send()){
        XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
        $data['errors']['mail'] = "Mail could not be send";
    }
    else {
        if($success_page > 0) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $success_page);
        }
        else {
            $data['success'] = "Your successfully registred";
        }
    }
    
}
else {
    $data['errors'] = $errors;
}

?>