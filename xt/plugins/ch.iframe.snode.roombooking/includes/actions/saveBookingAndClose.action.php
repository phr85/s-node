<?php
XT::call('saveBooking');
if(!is_array(XT::getValue("timeerror"))){
    $GLOBALS['plugin']->setAdminModule("lb");

}

?>