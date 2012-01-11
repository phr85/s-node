<?php

// Parameter :: Style
$style = XT::autoval("style", "R", "", true);

if($style == "") {
    $style = XT::autoval("style", "P", "default.tpl", true);
}

// Parameter :: ID
$event_id = intval(XT::autoval("event_id", "R", 0, true));

// Parameter :: Success Page
$success_page = intval(XT::autoval("success_page", "P", "", true));

// Request :: $_POST['register']
$register = XT::autoval("register", "R", "", true);

if(is_array($register)) {
    if(is_array($register[acco_pers])) {
        
        $clean_acco_pers = array();
        $i = 1;
        
        foreach($register[acco_pers] as $person) {
            // If theres no firstname and no lastname available dont take the entry
            if(!empty($person['firstName']) OR !empty($person['lastName'])) {
                foreach($person as $key => $value) {
                    $clean_acco_pers[$i][$key] = $value;
                }
            }
            $i++;
        }
        
        $register[acco_pers] = $clean_acco_pers;
        
    }
}

// Nur falls eine ID vorhanden ist Werte zuweisen
if($event_id > 0) {
    
    // Die freien Plaetze abrufen
    $result = XT::query("
        SELECT
            (max_visitors - reg_visitors) as freeplaces
        FROM
            " . XT::getTable("events") . "
        WHERE
            id = " . $event_id . " AND
            max_visitors > 0
        LIMIT 1
    ",__FILE__,__LINE__);
    
    $row = $result->fetchRow();
    
    if($row['freeplaces'] != "") {
        $data['data']['freeplaces'] = $row['freeplaces'];
    }
    
    // Hier wird "action" definiert
    if(isset($_POST["x" . XT::getBaseID() . "_register_submit"]) && !empty($_POST["x" . XT::getBaseID() . "_register_submit"])) {
        include('perform.php');
    }
    
    // ID zuweisen
    $data['data']['event_id'] = $event_id;
    
    // Eventtitel zuweisen
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
    $row = $result->fetchRow();
    
    $data['data']['event_title'] = $row['title'];
    
    // Formular Daten zuweisen
    $data['input_values'] = $register;
    
    // Daten Smarty zuweisen
    XT::assign("xt" . XT::getBaseID() . "_registration", $data);
    
    // Das Template erstellen
    $content = XT::build($style);
}

?>