<?php

$result = XT::query("
    SELECT
        base_id,
        package_id,
        title,
        description,
        version
    FROM
        " . $GLOBALS['plugin']->getTable('packages_installed') . "
    ");

$packages = array();
while($row = $result->FetchRow()){
    // format version
    $version_suffix = substr($row['version'],-2);
    $row['version'] = substr($row['version'],0,-2) . "." . $version_suffix;
    $packages[] = $row;
}
XT::assign('PACKAGES', $packages);

// Check for updates
$result = XT::query("
    SELECT
        id,
        package_id,
        version,
        reqversion
    FROM
        " . $GLOBALS['plugin']->getTable('updates') . "
    GROUP BY
        id
    ");

$updates = array();
while($row = $result->FetchRow()){
    // format version
    $version_suffix = substr($row['version'],-2);
    $row['version'] = substr($row['version'],0,-2) . "." . $version_suffix;

    $updates[$row['package_id']][] = $row;
    $updates[$row['package_id']]['count']++;
}
XT::assign('UPDATES', $updates);

$content = XT::build("overview.tpl");

/*
// create buttons
//$GLOBALS['plugin']->addButton('Update repository', 'updateRepository');
include_once('hash.php');
$GLOBALS['plugin']->setSessionValue('soap_accesskey','');
$GLOBALS['plugin']->setSessionValue('modus','');

$GLOBALS['tpl']->assign("BUTTONS", $GLOBALS['plugin']->getButtons());

// get installed packages
$sql = sprintf("select distinct pk.package, pk.description from %s md, %s pk, %s pl WHERE pk.id = md.package AND pl.module = md.id ORDER BY pk.package ASC",
                    $GLOBALS['plugin']->getTable('modules'),
                    $GLOBALS['plugin']->getTable('packages'),
                    $GLOBALS['plugin']->getTable('plugins')
                    );

$result = XT::query($sql);
XT::errorCheck(__FILE__,__LINE__);


$packages = array();
$i =0;

while($row = $result->FetchRow()){
    // get package id
    $sql = "SELECT id FROM " . $GLOBALS['plugin']->getTable('packages') . " WHERE package='" . $row['package'] ."'";
    $resultpid = XT::query($sql);
    XT::errorCheck(__FILE__,__LINE__);
    $rowpid = $resultpid->FetchRow();

    $pid =  $rowpid[0];
    $package_name = $row['package'];

    $sql = "SELECT count(up.id) AS available
            FROM ". $GLOBALS['plugin']->getTable('updates') ." AS up," .$GLOBALS['plugin']->getTable('modules') . " AS md
            WHERE up.module = md.module AND up.package='$package_name' and md.package=$pid";


    $resultupdate = XT::query($sql);
    XT::errorCheck(__FILE__,__LINE__);
    $rowupdate = $resultupdate->FetchRow();

    //XT::printLine($row['package'] . ': ' . $rowupdate['available']);

    if($rowupdate['available'] > 0) {
        $package['update'] = 'box_add';
    }
    else {
        $package['update'] = 'box';
    }

    $package['id'] = urlencode($row['package']);
    $package['name'] = $row['package'];
    $package['description'] = $row['description'];
    $packages[$i++] = $package;
}


$GLOBALS['tpl']->assign('PACKAGES', $packages);
$content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'overview.tpl');

*/
?>