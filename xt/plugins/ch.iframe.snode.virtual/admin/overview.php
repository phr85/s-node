<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

$GLOBALS['plugin']->contribute("overview_buttons", "Add Virtual", "addVirtual","document_add.png","0","slave1");

$result = XT::query("SELECT 
                        * 
                     FROM 
                        " . $GLOBALS['plugin']->getTable('virtual_url') , __FILE__, __LINE__);

XT::assign('DATA', XT::getQueryData($result));

$content = XT::build('overview.tpl');
?>