<?php
$sql = "SELECT
            p.package,  c.module, c.params, c.active, c.position
        FROM
            " . XT::getTable('navigation_contents') . " AS c,
            " . XT::getTable('plugins_packages') . " AS p

        WHERE
            c.node_id=" .XT::getValue('node_id') . " AND
            c.package = p.id

        AND
            c.lang = '" . XT::getActiveLang() . "'
        ORDER BY
            c.position ASC";

$result = XT::query($sql, __FILE__, __LINE__);
$insert_lines = "";

$i=0;
while ($row = $result->fetchRow()) {
    if($row['active'] == 1){
        $replacements[$i] = '{plugin package="' . $row['package'] .  '" module="'  . $row['module'] . '" ' . $row['params'] . ' ncpos="' . $row['position'] . '"}';
    }else{
        $replacements[$i] = '{plugin package="' . $row['package'] .  '" module="'  . $row['module'] . '" ' . $row['params'] . ' ncpos="' . $row['position'] . '"}';
        $deactivate[$i] = '<!--P' . $i . '-->';
    }
    $i++;
}
// Get template dir
$sql = "SELECT
            tpl_file
        FROM
            " . XT::getTable('navigation_details') . "
        WHERE
            node_id=" . XT::getValue('node_id') . " AND
            lang='" . XT::getPluginLang() . "'";

$result = XT::query($sql, __FILE__, __LINE__);
$row = $result->fetchRow();

$file = PAGES_DIR . $row['tpl_file'];

$failed = false;

if (!is_writable($file)) {
    XT::log("Requested template file is not writeable", __FILE__, __LINE__,XT_ERROR);
    $failed = true;
}

if (!$failed) {
    $pluginMatched = false;
    $insertBefore = '';
    $insertAfter = '';

    $datei = file_get_contents($file);

    if(is_array($replacements)){
        //Deaktivierungen kurzfristig aktivieren
        foreach ($replacements as $key => $plugincall){
            
            $datei = str_replace('<!--P' . $key . '-->', $plugincall,$datei);
        }
    }

    preg_match_all('/{plugin[^}]+ncpos=\"[0-9]+\"}/',$datei,$matches);

    // Alle elemente auf der page durch platzhalter ersetzen
    foreach ($matches[0] as $key => $plugincall){
        if(!strstr($datei,'<!--P' . $key . '-->')){
            $datei = str_replace($plugincall, '<!--P' . $key . '-->' ,$datei);
        }
    }

    $matchcount = count($matches[0]);
    $replcount = count($replacements);

    // <!--P0--> einsetzen wenn keins da ist
    if(!strstr($datei,"<!--P0-->")){
        $datei .= "<!--P0-->";
    }


    // wenn element zu l?schen ist
    if(XT::getValue('action') == 'deleteContent'){
        if($replcount>0){
            $datei = str_replace('<!--P' . $replcount . '-->', '',$datei);
        }
        $restkey ++;
    }

    // austausch der bestehenden
    if(is_array($replacements)){
        foreach ($replacements as $key => $plugincall){
            if(($key + 1) < $matchcount){
                $datei = str_replace('<!--P' . $key . '-->', $plugincall,$datei);
            }
            if(($key + 1) >= $matchcount){
                if($key + 1 == $replcount){
                    $datei = str_replace('<!--P' . $key . '-->', $plugincall,$datei);
                }else{
                    $datei = str_replace('<!--P' . $key . '-->', $plugincall . '<!--P' . ($key + 1) . '-->',$datei);
                }
            }
        }
    }
    $matches[0] = array_slice($matches[0],1);
    $restkey ++;


    // ?berz?hlige elemente im tpl abarbeiten (an die position des letzten elementes anh?ngen)
    foreach ($matches[0] as $key => $plugincall){
        $datei = str_replace('<!--P' . ($key + $restkey) . '-->',$plugincall,$datei);
        // die restlichen elemente registrieren
    }
    if(is_array($deactivate)){
        //Deaktivierungen
        foreach ($deactivate as $key => $plugincall){
            $datei = str_replace($replacements[$key],'<!--P' . $key . '-->',$datei);
        }
    }
    $fp = null;
    $fp = fopen($file, 'w');
    fwrite($fp, $datei);

    fclose($fp);
}
?>