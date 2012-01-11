<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

// Build plugin using template overview.tpl
$content = XT::build("overview.tpl");

?>