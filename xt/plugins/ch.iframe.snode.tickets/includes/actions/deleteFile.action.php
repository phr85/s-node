<?php
$ticket_id = XT::getValue('id');
$fileloc = DATA_DIR . "ticketing/" . $ticket_id . "/" . XT::getValue('file');
unlink($fileloc);
XT::setAdminModule('edit');
?>