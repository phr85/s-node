<?php

// load code common to ADOdb
include(CLASS_DIR . 'db/adodb/adodb.inc.php');

global $db;
$db = &ADONewConnection('mysql');
$ADODB_COUNTRECS = false;
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$db->Connect($GLOBALS['cfg']->get('database','host'), $GLOBALS['cfg']->get('database','user'), $GLOBALS['cfg']->get('database','pass'), $GLOBALS['cfg']->get('database','database'));
//$db->Query("SET NAMES 'utf8'");
?>