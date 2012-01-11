<?php
$daterange=getDateRange(XT::getSessionValue("date"),"week");
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
           room.title as room,
           book.*,
           (book.date_to - book.date_from) as duration
            FROM
        " . $GLOBALS['plugin']->getTable("bookings") . " as book
    LEFT JOIN 
        " . XT::gettable("user") . " as usr on(book.creation_user = usr.id)
    LEFT JOIN 
        " . XT::gettable("rbs_rooms") . " as room on(book.room_id = room.id)
    WHERE
        book.room_id = " . $GLOBALS['plugin']->getSessionValue("room_id") . "
    AND
        book.date_from >= " . $daterange[0] . "
    AND
        book.date_to <= " . $daterange[1] . "
        ORDER by book.date_from asc"      
,__FILE__,__LINE__);

while($row = $result->FetchRow()){
    // sonntag ist hinten
    if(0 >= date("w",$row['date_from']) && 0 <= date("w",$row['date_to'])){
        $bookings[6][]=$row;
    }
    for ($i = 1; $i < 7; $i++) {
        if($i >= date("w",$row['date_from']) && $i <= date("w",$row['date_to'])){
            $bookings[$i-1][]=$row;
        }

    }

}
$days=array();
for ($i = 0; $i < 7; $i++) {
    $days[$i] = $daterange[0] + ($i * 86400) ;
}
XT::assign("DAYS",$days);

XT::assign("BOOKINGS", $bookings);
if (date("w", XT::getSessionValue("date"))==0){
    $selectedday = 6;
}else {
	$selectedday = date("w", XT::getSessionValue("date")) -1 ;
}
XT::assign("SELECTED_DAY", $selectedday);

XT::assign("COUNTS", $bookingcount);
XT::assign("DATERANGE",$daterange);
$content = XT::build("listBooking/week.tpl");
?>