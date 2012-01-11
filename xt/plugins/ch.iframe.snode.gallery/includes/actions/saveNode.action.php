<?php

$title = XT::getValue("title");

$result = XT::query("
    SELECT
        node_id
    FROM
        " . XT::getTable("galleries_details") . "
    WHERE
        node_id =" . XT::getValue("node_id") . "
        AND lang = '" . XT::getValue("save_lang") . "'
",__FILE__,__LINE__);

$data = XT::getQueryData($result);

if($data[0]['node_id'] == '') {

    XT::query("
        INSERT INTO " . XT::getTable("galleries_details") . "
        (
            node_id,
            creation_date,
            creation_user,
            title,
            description,
            lang,
            image,
            image_version,
            active,
            public
        ) VALUES (
            " . XT::getValue("node_id") . ",
            " . TIME . ",
            " . $_SESSION['user']['id'] . ",
            '" . $title . "',
            '" . XT::getValue('description') . "',
            '" . XT::getValue("save_lang") . "',
            '" . XT::getValue("image") . "',
            '" . XT::getValue("image_version") . "',
            '" . XT::getValue('active') . "',
            '" . XT::getValue('public') . "'
        )
    ",__FILE__,__LINE__);

}
else {

    if(XT::getValue('public')) {
        $public = 1;
    }
    else {
        $public = 0;
    }

    XT::query("
        UPDATE
            " . XT::getTable("galleries_details") . "
        SET 
            mod_date = " . TIME . ",
            mod_user = " . $_SESSION['user']['id'] . ",
            title = '" . $title . "',
            description = '" . XT::getValue('description') . "',
            image = " . XT::getValue("image") . ",
            image_version = " . XT::getValue("image_version") . ",
            public = " . $public . "
        WHERE
            node_id =" . XT::getValue("node_id") . "
        AND
            lang = '" . XT::getValue("save_lang") . "'
    ",__FILE__,__LINE__);

}



XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex(XT::getValue("node_id"),$GLOBALS['plugin']->getContentType("Gallery"),XT::getValue('public'));
$search->add(XT::getValue("keywords"), 1);
$search->build(XT::getValue("title"), XT::getValue("description"));

if(XT::getValue("image") > 0){
    $search->setImage(XT::getValue("image"));
}

?>