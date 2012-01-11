<?php
// Save the status
XT::setValue("id",XT::getValue("ticket_id"));
XT::setValue("status_comment",XT::getValue("status_comment_" . XT::getValue("ticket_id")));
XT::call("statusChange");
?>