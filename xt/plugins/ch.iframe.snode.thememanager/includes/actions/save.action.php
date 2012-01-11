<?php

$file = fopen(XT::getValue('path'),"w");
fwrite($file, stripslashes(XT::getValue('content')));
fclose($file);

XT::setAdminModule('et');

?>