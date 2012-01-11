<?php
XT::query("DELETE from " . XT::gettable("bookings") . " WHERE id = " . XT::getValue("id"),__FILE__,__LINE__);
?>