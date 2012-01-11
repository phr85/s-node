<?php
if ($GLOBALS['plugin']->getValue('preview') != 1){
    // Parameter :: ID
    $id = $GLOBALS['plugin']->getParam('id') != '' ? $GLOBALS['plugin']->getParam('id') : $GLOBALS['plugin']->getValue('id');
    $baselang = XT::autoval("baselang","P", $GLOBALS['cfg']->get('lang', 'default'));

    if($id > 0){
        // Select informations from content navigation
        $result = XT::query("
            SELECT
                nc.node_id,
                nc.package,
                nd.public,
                nd.active
            FROM
                " . $GLOBALS['plugin']->getTable("navigation_contents") . " as nc
            LEFT JOIN
                " . $GLOBALS['plugin']->getTable("navigation_details") . "  as nd ON (nd.node_id=nc.node_id)
            WHERE
                nc.package=" . $GLOBALS['plugin']->getBaseID() . "  AND (nc.params like '%id=" . $id . "%' OR nc.params like '%id=\"" . $id . "\"%')
                AND nc.lang='" . $baselang . "'
                GROUP by nc.id
                ORDER by nd.public DESC, nc.node_id DESC
            ",__FILE__,__LINE__);
        $data = array();
        while($row = $result->FetchRow()){
            if($row['public'] == 1 && $row['active'] == 1){
                header("Location: http://" . $_SERVER['HTTP_HOST']
                . $_SERVER['PHP_SELF']
                . "?TPL=" . $row['node_id']);
                die();
            }
        }
    }
}

?>