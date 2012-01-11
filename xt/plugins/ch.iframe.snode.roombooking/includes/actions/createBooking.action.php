<?php

$starttime = mktime(XT::getValue("hstart"),XT::getValue("mstart"),0,XT::getValue("month"),XT::getValue("day"),XT::getValue("year"));
$endtime = mktime(XT::getValue("hend"),XT::getValue("mend"),0,XT::getValue("month"),XT::getValue("day"),XT::getValue("year"));
    
if(!checkCollission(XT::getValue('room_id'),$starttime,$endtime,0,0)){
   XT::setValue("DATECOLLISION",true) ;
}elseif ($starttime < $endtime){
    XT::setValue("DATECOLLISION",false) ;
    // write data
    XT::query("INSERT INTO  " . XT::getTable('bookings') . " set
    mod_date=" . TIME . ",  
    creation_date=" . TIME . ",  
    room_id='" . XT::getValue('room_id') . "',
    mod_user=" . XT::getUserID() . ",  
    creation_user=" . XT::getUserID() . ",  
    title='" . XT::getValue('title') . "',  
    comment='" . XT::getValue('comment') . "',  
    date_from='" . $starttime . "',  
    date_to='" . $endtime . "'"
    ,__FILE__,__LINE__);
    XT::setValue("booking_added",true);
}else {
	XT::setValue("TIMEAUTOSET",true) ;
}
?>