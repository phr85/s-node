<?php
XT::assign("xt" . XT::getBaseID() . "_desktop",$XTMSG->get_received());

$content = XT::build(XT::autoval("style","P","default.tpl"));

?>
