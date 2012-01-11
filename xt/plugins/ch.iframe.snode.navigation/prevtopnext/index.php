<?php

// Parameter :: Style
$data['params']['style'] = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

// Parameter :: Node
$data['params']['node'] = XT::autoval("node", "P", $GLOBALS['tpl_id']);

$result = XT::query("
    SELECT
        if(target.id = selector.pid ,'top', if(target.l < selector.l,'prev','next')) as ptype,
        details.node_id as id,
        details.title,
        details.active,
        details.public,
        target.l,
        target.r,
        target.pid,
        target.level
    FROM 
        " . XT::getTable("navigation") . " as selector,
        " . XT::getTable("navigation") . " as target
    LEFT JOIN
        " . XT::getTable("navigation_details") . " AS details ON (target.id = details.node_id and details.lang = '" . XT::getLang() . "')
    WHERE
        selector.id = " . $data['params']['node'] . " AND
        (
            target.id = selector.pid OR
            (target.r = selector.l -1 AND target.pid = selector.pid) OR
            (target.l = selector.r +1 AND target.pid = selector.pid)
        )
    ORDER BY
        target.l ASC
",__FILE__,__LINE__);

while($row = $result->fetchRow()) {
    $data['data'][$row['ptype']] = $row;
    unset($data['data'][$row['ptype']]['ptype']);
}

XT::assign("xt" . XT::getBaseID() . "_prevtopnext", $data);

// build content
$content = XT::build($data['params']['style']);

?>