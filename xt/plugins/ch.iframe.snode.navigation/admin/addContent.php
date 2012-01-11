<?php

XT::assign('MODE',$GLOBALS['plugin']->getAdminModule());
$node_id  = $GLOBALS['plugin']->getValue('node_id');
$node_pid = $GLOBALS['plugin']->getValue('node_pid');
XT::assign('INSERT_POS',XT::getValue('insert_pos'));
XT::assign('LIVETPL',XT::getValue('livetpl'));
$sql = "SELECT
             *,
             floor((r-l-1)/2) AS subs,
             (level * 20) AS padding
        FROM
            " . $GLOBALS['plugin']->getTable('plugins_contents') . " as pc
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('plugins_contents_details') . " as pcd ON (pcd.node_id = pc.id AND pcd.lang='de')
        WHERE
            level > 1
        ORDER BY
            l
        ASC";

$result = XT::query($sql, __FILE__, __LINE__);


XT::assign('NODE_ID', $node_id);
XT::assign('NODE_PID', $node_pid);


XT::assign('NODES', XT::getQueryData($result));


$result = XT::query("SELECT pcr.*, pm.title, pm.description
        FROM
            " . $GLOBALS['plugin']->getTable('plugins_contents_rel') . " as pcr
        LEFT JOIN
            " . $GLOBALS['plugin']->getTable('plugins_modules') . " as pm ON(pcr.package = pm.package AND pcr.module = pm.module AND pm.lang = 'de')
        ", __FILE__, __LINE__);


$modules = array();
while($row = $result->FetchRow()){
    $modules[$row['node_id']][] = $row;
}
XT::assign('MODULES', $modules);

$content = XT::build('addContent.tpl');
?>