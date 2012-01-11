<?php

include($GLOBALS['plugin']->location . "../includes/config.inc.php");

if($GLOBALS['plugin']->getPostValue('mod') == ''){
    $GLOBALS['plugin']->setPostValue('mod','list');
}

switch ($GLOBALS['plugin']->getPostValue('mod')) {

    case 'list':
        include('list.php');
        break;

    case 'add':
        include('actions/actions.php');
        include('add.php');
        break;
}

?>