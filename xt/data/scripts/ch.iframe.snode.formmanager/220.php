<?php
//Scripting identifier must be 'email'
if(!XT::checkEmail(trim($fields['email']))) {
    $error = XT::translate('E-Mail invalid');
}
?>