<?php

$data['form']['fillout'] = array();
$data['form']['errors'] = array();

// Das Formular nach dem Schema durchgehen
foreach($data['form']['fields'] as $fieldname => $field) {
    // Den Inhalt zuweisen
    $data['form']['fillout'][$fieldname] = $_POST['application'][$fieldname];
    if(!get_magic_quotes_gpc()) {
        $data['form']['fillout'][$fieldname] = addslashes($data['form']['fillout'][$fieldname]);
    }
    // Inputs, einfache Selects
    if(!is_array($data['form']['fillout'][$fieldname])) {
        // Bei Plichtfeldern ohne Wert einen Fehler ausgeben
        if(isset($_POST['application']['submit']) && isset($field['required']) && $field['required'] && $data['form']['fillout'][$fieldname] == "") {
            $data['form']['errors'][$fieldname]['empty'] = 1;
        }
        // Bei Feldern mit Pruefunktionen einen Fehler ausgeben und den Wert zueruecksetzen, falls die Funktion false zurueck gibt
        elseif(isset($field['callback_func']) && !empty($field['callback_func']) && !call_user_func($field['callback_func'], $data['form']['fillout'][$fieldname])) {
            $data['form']['fillout'][$fieldname] = "";
            // Nur bei benoetigten Feldern Alarm schlagen
            if(isset($_POST['application']['submit']) && isset($field['required']) && $field['required']) {
                $data['form']['errors'][$fieldname]['invalid'] = 1;
            }
        }
    }
    // Mehrfachauswahl selects und checkboxen
    else {
        // Bei Plichtfeldern ohne Wert einen Fehler ausgeben
        if(isset($_POST['application']['submit']) && isset($field['required']) && $field['required'] && count($data['form']['fillout'][$fieldname]) == 0) {
            $data['form']['errors'][$fieldname]['empty'] = 1;
        }
    }
}
// Falls keine Jobid angeben wurde einen Fehler ausgeben
if(intval($_POST['application']['job_id']) == 0 && isset($_POST['application']['submit'])) {
    $data['form']['errors']['job_id']['empty'] = 1;
}


// Die bestehenden Dateien zuweisen
if(isset($_POST['application']['uploaded_files']) && !empty($_POST['application']['uploaded_files'])) {
    foreach($_POST['application']['uploaded_files'] as $file) {
        $data['files'][$file['name']] = $file;
    }
}
$f = 0;
// Die neuen Dateien zuweisen
if(isset($_FILES['application']) && !empty($_FILES['application'])) {
    foreach($_FILES['application']['name']['files'] as $file) {
        if($_FILES['application']['error']['files'][$f] == 0) {
            move_uploaded_file($_FILES['application']['tmp_name']['files'][$f], "/tmp/" . md5($_FILES['application']['name']['files'][$f]));
            $data['files'][$_FILES['application']['name']['files'][$f]]['name'] = $_FILES['application']['name']['files'][$f];
            $data['files'][$_FILES['application']['name']['files'][$f]]['type'] = $_FILES['application']['type']['files'][$f];
            $data['files'][$_FILES['application']['name']['files'][$f]]['tmp_name'] = "/tmp/" . md5($_FILES['application']['name']['files'][$f]);
            $data['files'][$_FILES['application']['name']['files'][$f]]['size'] = $_FILES['application']['size']['files'][$f];
        }
        $f++;
    }
}
// Datei aus Liste entfernen
if(isset($_POST['application']['delete_file']) && !empty($_POST['application']['delete_file'])) {
    unset($data['files'][$_POST['application']['delete_file']]);
}


// Formular verarbeiten
if(isset($_POST['application']['submit']) && count($data['form']['errors']) == 0) {

    // Den Bewerbungsnode fuer diesen Job ausfindig machen
    $result = XT::query("
        SELECT
            job_node
        FROM
            " . XT::getTable("jobs") . "
        WHERE
            id = {$_POST['application']['job_id']}
    ",__FILE__,__LINE__);
    
    $res = $result->FetchRow();
    $job_node = $res['job_node'];
    
    // Einen Unterordner Pro Bewerbung hinzufuegen
    $tree = new XT_Tree("files_tree");
    $application_node = $tree->addChildNode($job_node);
    
    // Dem neuen Node den Namen des Bewerbers zuteilen
    XT::query("
        INSERT INTO " . XT::getTable("files_tree_details") . " (
            node_id,
            lang,
            creation_date,
            creation_user,
            title,
            active,
            isFolder,
            public
        ) VALUES (
            '" . $application_node . "',
            '" . XT::getLang() . "',
            '" . TIME . "',
            '" . XT::getUserID() . "',
            '" . $data['form']['fillout']['last_name'] . " " . $data['form']['fillout']['first_name'] . "',
            1,
            1,
            0
        )
    ",__FILE__,__LINE__);
    
    // Die Bewerbung eintragen
    XT::query("
        INSERT INTO " . XT::getTable("jobs_applications") . " (
            application_node,
            job_id,
            creation_date,
            creation_user
        ) VALUES (
            {$application_node},
            {$_POST['application']['job_id']},
            " . TIME . ",
            '" . XT::getUserID() . "'
        )
    ",__FILE__,__LINE__);
    
    // Die Bewerbungs ID auslesen
    $result = XT::query("
        SELECT
            id
        FROM
            " . XT::getTable("jobs_applications") . "
        WHERE
            job_id = {$_POST['application']['job_id']} AND
            creation_date = " . TIME . "
        ORDER BY
            id DESC
        LIMIT 1
    ",__FILE__,__LINE__);
    
    $res = $result->FetchRow();
    $application_id = $res['id'];
    
    // Die Daten eintragen
    foreach($data['form']['fillout'] as $key => $value) {
        if(!$data['form']['fields'][$key]['dont_save']) {
            if(is_array($value)) {
                $value = implode(",", $value);
            }
            XT::query("
                INSERT INTO " . XT::getTable("jobs_applications_values") . " VALUES (
                    NULL,
                    {$application_id},
                    '{$key}',
                    '{$value}'
                )
            ",__FILE__,__LINE__);
        }
    }
    
    // Alle Dateien eintragen
    if(count($data['files']) > 0) {
        foreach($data['files'] as $file) {
            
            $file['width'] = 0;
            $file['height'] = 0;
            $file['data_type'] = 0;

            $size = getimagesize($file['tmp_name']);
            
            // Falls es ein Bild ist die Dimensionen anpassen
            if(isset($size[0]) && intval($size[0]) > 0) {
                $file['width'] = intval($size[0]);
                $file['height'] = intval($size[1]);
                $file['data_type'] = 1;
            }
            
            // Die Datei eintragen
            XT::query("
                INSERT INTO " . XT::getTable("files") . " (
                    filesize,
                    upload_date,
                    upload_user,
                    type,
                    width,
                    height,
                    filename,
                    md5sum
                ) VALUES (
                    '" . $file['size'] . "',
                    '" . TIME . "',
                    '" . XT::getUserID() . "',
                    '" . $file['data_type'] . "',
                    '" . $file['width'] . "',
                    '" . $file['height'] . "',
                    '" . $file['name'] . "',
                    '" . md5(file_get_contents($file['tmp_name'])) . "'
                )
            ",__FILE__,__LINE__);
            
            // Die ID der Datei ermitteln
            $result = XT::query("
                SELECT
                    id
                FROM
                    " . XT::getTable("files") . "
                WHERE
                    filesize = '" . $file['size'] . "' AND
                    upload_date = '" . TIME . "' AND
                    upload_user = '" . XT::getUserID() . "' AND
                    type = '" . $file['data_type'] . "' AND
                    width = '" . $file['width'] . "' AND
                    height = '" . $file['height'] . "' AND
                    filename = '" . $file['name'] . "'
                ORDER BY
                    id DESC
                LIMIT 1
            ",__FILE__,__LINE__);
            
            $row = $result->fetchRow();
            $file_id = $row['id'];
            
            // Die Details eintragen
            XT::query("
                INSERT INTO " . XT::getTable("files_details") . " (
                    id,
                    lang,
                    title
                ) VALUES (
                    '" . $file_id . "',
                    '" . XT::getLang() . "',
                    '" . $file['name'] . "'
                )
            ",__FILE__,__LINE__);
            
            // Die Datei in den Ortner eintragen
            XT::query("
                INSERT INTO " . XT::getTable("files_rel") . " (
                    node_id,
                    file_id
                ) VALUES (
                    '" . $application_node . "',
                    '" . $file_id . "'
                )
            ",__FILE__,__LINE__);
            
            // Die Datei an den richtigen Ort verschieben
            rename($file['tmp_name'], DATA_DIR . "files/{$file_id}");
            
        }
    }
    
    // Alle Dateien zuruecksetzen
    unset($data['files']);

    // Vorbereitung zur Action
    XT::setValue("id", $application_id);
    if(isset($data['form']['fillout']["copy"][1])) {
        XT::setValue("copy", 1);
    }
    
    // E-Mail versenden
    XT::call("sendApplication");
    
    // Die Rueckgabewerte der Action zuweisen
    if(XT::getValue("sent")) {
        $data['form']['success'] = "Your application has been sent!";
    }
    else {
        $data['form']['errors']['mail']['sent'] = "Mail could not be send! Please send a Mail with this error to the admin!";
    }

}

?>