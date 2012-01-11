<?php
// Achtung: Scripting identifier muss plz heissen oder der code muss angepasst werden.
if(!ereg('^[0-9]{4,5}$',$fields['plz'])){
    $error = XT::translate('no zip');
}

?>