<?php

// passwort aktualisieren
function setPasswdForID($userid,$encryptedpasswd){
    XT::query("UPDATE " . XT::getTable('user') . " SET password = '" . $encryptedpasswd . "' WHERE id = '" . $userid . "'",__FILE__,__LINE__);
}

// verschlüsseltes kennwort erstellen
function generateEncryptedPassword($cleartextpasswd){
    return md5($cleartextpasswd . $GLOBALS['cfg']->get("system", "magic"));
}

// zufallskennwort in klartext generieren
function generateCleartextPassword( $len = 10 )
{
    $salt = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvXxYyZz0123456789';
    $salt_max = strlen( $salt ) - 1 ;
    $pass = '' ;
    for( $i=0; $i < $len; $i++ ) {
        $pass .= substr( $salt, mt_rand(0, $salt_max), 1 ) ;
    }
    return $pass ;
}

?>