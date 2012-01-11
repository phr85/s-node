<?php

XT::query("INSERT " . XT::getTable("bookings") . " ( 
`room_id`, `creation_date`, `creation_user`)
values 
('" . XT::getValue('room_id') . "',  '" . TIME . "',  '1' )
",__FILE__,__LINE__);

$result = XT::query("SELECT id from " . XT::getTable("bookings") . " WHERE room_id = " . XT::getValue('room_id') . " AND creation_date = " . TIME ,__FILE__,__LINE__);
$id = XT::getQueryData($result);

XT::setValue("booking_id",$id[0]['id']);

$GLOBALS['plugin']->setAdminModule('eb');

?>