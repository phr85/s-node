<?php
// Get all bookings from room
$result = XT::query("
    SELECT usr.username, 
           usr.firstName,
           usr.lastName,
           usr.street,
           usr.plz,
           usr.city,
           usr.email,
           usr.tel,
           usr.facsimile,
           usr.lang,
           usr.description,
           usr.image,
           usr.image_version,
    book.* FROM
        " . $GLOBALS['plugin']->getTable("bookings") . " as book
    LEFT JOIN 
        " . XT::gettable("user") . " as usr on(book.creation_user = usr.id)
    WHERE
        book.room_id = " . $GLOBALS['plugin']->getSessionValue("room_id") . "
    AND
        book.date_from >= " . $daterange[0] . "
    AND 
        book.date_from <= " . $daterange[1] . " ORDER by book.date_from asc"      
,__FILE__,__LINE__);

XT::assign("BOOKINGS", XT::getQueryData($result));
XT::assign("COUNTS", $bookingcount);
XT::assign("DATERANGE",$daterange);
$content = XT::build("listBooking/year.tpl");
?>