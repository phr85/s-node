<?php
if(XT::getValue("category_id")!="" && XT::getValue("title") != ""){
    XT::query("insert into  " . XT::getTable('forum_forums') . "
    ( `id`, `category_id`, `title`, `description`) 
    values 
    (  NULL,  '" . XT::getValue("category_id") . "',  '" . XT::getValue("title") . "',  '" . XT::getValue("description") . "')"
    ,__FILE__,__LINE__);
}
?>