<?php

// timer
$sdate = XT::getValue('sdate');
if($sdate > 0){
    XT::setValue('sdate',mktime(XT::getValue('hstart') ,XT::getValue('mstart'),0,date('m',$sdate),date('d',$sdate),date('y',$sdate)));
}
$edate = XT::getValue('edate');
if ($edate > 0){
    XT::setValue('edate',mktime(XT::getValue('hend') ,XT::getValue('mend'),0,date('m',$edate),date('d',$edate),date('y',$edate)));
}

if(XT::getValue('title') == ""){
    XT::setValue('title','untitled') ;
}

if(XT::getValue('edate') < (XT::getValue('sdate') + XT::getConfig("blocksize"))){
    XT::setValue('edate',(XT::getValue('sdate') + XT::getConfig("blocksize")));
}

if(!checkCollission(XT::getValue('room_id'),XT::getValue('sdate'),XT::getValue('edate'),XT::getValue('booking_id'),0)){
    XT::log(XT::translate("date collision"),__FILE__,__LINE__,XT_ERROR,XT::getBaseID(),XT::getValue('booking_id'),"saveBooking");
    XT::query("UPDATE " . XT::getTable('bookings') . " set
    mod_date=" . TIME . ",  
    mod_user=" . XT::getUserID() . ",  
    title='" . XT::getValue('title') . "',  
    comment='" . XT::getValue('comment') . "'
    where id=" . XT::getValue('booking_id')
    ,__FILE__,__LINE__);
    $timeerror[0] = XT::getValue('sdate');
    $timeerror[1] = XT::getValue('edate');
    XT::setValue("timeerror",$timeerror);
}else{
    XT::query("UPDATE " . XT::getTable('bookings') . " set
    mod_date=" . TIME . ",  
    mod_user=" . XT::getUserID() . ",  
    title='" . XT::getValue('title') . "',  
    comment='" . XT::getValue('comment') . "',  
    date_from='" . XT::getValue('sdate') . "',  
    date_to='" . XT::getValue('edate') . "' 
    where id=" . XT::getValue('booking_id')
    ,__FILE__,__LINE__);
}
?>