<?php
// get package id
$sql = "SELECT id FROM " . $GLOBALS['plugin']->getTable('packages') . " WHERE package='" . $GLOBALS['plugin']->getValue('id') ."'";
$result = XT::query($sql);
$row = $result->FetchRow();
$pid =  $row['id'];

// get modules
$sql = sprintf("SELECT pl.label,md.id, md.module, md.version, md.description, md.path
                FROM %s pl, %s md WHERE pl.module = md.id AND md.package=$pid",
                $GLOBALS['plugin']->getTable('plugins'),
                $GLOBALS['plugin']->getTable('modules'));


$result = XT::query($sql,__FILE__,__LINE__);

$modules = array();
$i=0;

while ($row = $result->FetchRow()) {
    $sql = sprintf("select count(*) as modified from %s where module =%s and md5 != origmd5",
                    $GLOBALS['plugin']->getTable('modfiles'),
                    $row['id']);

    $result_mod = XT::query($sql,__FILE__,__LINE__);
    $row_mod = $result_mod->FetchRow();

    $row['modified'] = (($row_mod[0] == 0) ? 'check' : 'forbidden');

    $modules[$i++] = $row;

}
$GLOBALS['tpl']->assign('MODULES', $modules);
$content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'package.tpl');
?>