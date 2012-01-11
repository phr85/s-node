<?php
function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

XT::addImageButton('Save','save','default','disk_blue.png','1','master','s');

XT::assign("DATABASE_HOST", $GLOBALS['cfg']->get("database","host"));
XT::assign("DATABASE_USERNAME", $GLOBALS['cfg']->get("database","user"));
XT::assign("DATABASE_PASSWORD", $GLOBALS['cfg']->get("database","pass"));
XT::assign("DATABASE_DATABASE", $GLOBALS['cfg']->get("database","database"));
XT::assign("DATABASE_PREFIX", $GLOBALS['cfg']->get("database","prefix"));
XT::assign("FILE_SECURITY", $GLOBALS['cfg']->get("system","disable_file_security"));

$content = XT::build('overview.tpl');

?>