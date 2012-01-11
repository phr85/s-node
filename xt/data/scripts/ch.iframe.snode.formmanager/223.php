<?php
if(!ereg('(a|e|i|o|u|A|E|I|O|U|Ä|Ö|Ü|ä|ö|ü)',$fields['street'][0])){
    $error = XT::translate('Unbekannter Strassenname');
}
if(!ereg('([0-9])',$fields['street'][1])){
    $error .= XT::translate('Das Feld Nr. muss eine Zahl enthalten');
}
?>