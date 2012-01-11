<?php

$result = XT::query("SELECT id,title,subtitle,maintext,image,image_version,image_link,image_link_target,image_zoom, rid,lang 
FROM " . XT::getTable('articles') . " 
WHERE maintext is not NULL",__FILE__,__LINE__);

while($original = $result->FetchRow()){

    // set levels up
    XT::query("UPDATE " . XT::getTable('articles_chapters') . " SET level=level+1 WHERE id =" . $original['id'] . " ORDER by level DESC" );
    // copy stuff
    XT::query("INSERT INTO " . XT::getTable('articles_chapters') . " (id,active,level,title,subtitle,maintext,image,image_version,image_link,image_link_target,image_zoom,rid,lang) values (
    " . $original['id'] . ",
    1,1,
    '" . addslashes($original['subtitle']) . "',
    NULL,
    '" . addslashes($original['maintext']) . "',
    '" . $original['image'] . "',
    '" . $original['image_version'] . "',
    '" . $original['image_link'] . "',
    '" . $original['image_link_target'] . "',
    '" . $original['image_zoom'] . "',
    " . $original['rid'] . ",
    '" . $original['lang'] . "'
    )",__FILE__,__LINE__);
    //reset maintext
     XT::query("UPDATE " . XT::getTable('articles') . " SET maintext=NULL, subtitle=NULL WHERE id =" . $original['id'] . " AND lang='" . $original['lang'] ."'",__FILE__,__LINE__);
    
}

// for _V

$result = XT::query("SELECT id,title,subtitle,maintext,image,image_version,image_link,image_link_target,image_zoom, rid,lang 
FROM " . XT::getTable('articles_v') . " 
WHERE maintext is not NULL",__FILE__,__LINE__);

while($original = $result->FetchRow()){

    // set levels up
    XT::query("UPDATE " . XT::getTable('articles_chapters_v') . " SET level=level+1 WHERE id =" . $original['id'] . " AND rid =" . $original['rid'] . " ORDER by level DESC" );
    // copy stuff
    XT::query("INSERT INTO " . XT::getTable('articles_chapters_v') . " (id,active,level,title,subtitle,maintext,image,image_version,image_link,image_link_target,image_zoom,rid,lang) values (
    " . $original['id'] . ",
    1,1,
    '" . addslashes($original['subtitle']) . "',
    NULL,
    '" . addslashes($original['maintext']) . "',
    '" . $original['image'] . "',
    '" . $original['image_version'] . "',
    '" . $original['image_link'] . "',
    '" . $original['image_link_target'] . "',
    '" . $original['image_zoom'] . "',
    " . $original['rid'] . ",
    '" . $original['lang'] . "'
    )",__FILE__,__LINE__);
    //reset maintext
     XT::query("UPDATE " . XT::getTable('articles_v') . " SET maintext=NULL, subtitle=NULL WHERE id =" . $original['id'] . " AND rid =" . $original['rid'] . " AND lang='" . $original['lang'] . "'",__FILE__,__LINE__);
    
}

$GLOBALS['plugin']->setAdminModule("l");

?>