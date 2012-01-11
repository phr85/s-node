<?php
// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// nur etwas machen wenn auch was gesetzt wurde
if(XT::getValue("password") !=''){
    // kennworte vergleichen
    if(XT::getValue("password") == XT::getValue("password_repeat")){
        // neues Kennwort setzen
        $md5pwd = generateEncryptedPassword(XT::getValue("password"));
        setPasswdForID(XT::getUserID(),$md5pwd);
        // Nachricht ausgeben
        $data['messages']['password'] = XT::translate("password changed");
    }else {
        // Fehler ausgeben
        $data['errors']['password'] = XT::translate("passwords not equal");
    }
}

// datenarray für das template aufbauen
$data['data'] = $_SESSION['user'];

// variablen dem Template zuweisen
XT::assign("xt" . XT::getBaseID() . "_passwdchange",$data);

// build content
$content = XT::build($style);

XT::clear_assign("xt" . XT::getBaseID() . "_passwdchange");
// zugewiesene variablen löschen

?>