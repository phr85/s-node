<?php

$result = XT::query("
    SELECT
        (max(position) +1) as position
    FROM
        " . XT::getTable('relations') . "
    WHERE
        content_type = " . XT::getBaseID() . " AND
        content_id = " . XT::getValue('node_id'). "
",__FILE__,__LINE__);

$position = XT::getQueryData($result);

if($position[0]['position'] == ""){
    $position[0]['position'] = 1;
}

XT::query("
    INSERT INTO " . XT::getTable('relations') . " (
        id,
        lang,
        content_id,
        content_type,
        target_content_type,
        target_content_id,
        priority,
        title,
        target_title,
        description,
        image,
        type,
        position
    ) VALUES (
        NULL,
        '" . XT::getActiveLang() . "',
        '" . XT::getValue('node_id') . "',
        '" . XT::getBaseID() . "',
        " . XT::getValue('ctype') . ",
        " . XT::getValue('cid') . ",
        '0',
        '" . XT::getTitleByContentType(5500, XT::getValue('node_id'), XT::getActiveLang()) . "',
        '" . $_REQUEST['ctitle'] . "',
        NULL,
        '0',
        '0',
        '" . $position[0]['position'] . "'
    )
",__FILE__,__LINE__);

?>