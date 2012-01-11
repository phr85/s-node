<?php
@ignore_user_abort();
@set_time_limit(0);

$ticket_id = XT::getValue('id');
$fileloc = DATA_DIR . "ticketing/" . $ticket_id . "/" . XT::getValue('file');

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"".XT::getValue('file') . "\"");
readfile($fileloc);
exit;
//XT::setAdminModule('edit');
?>