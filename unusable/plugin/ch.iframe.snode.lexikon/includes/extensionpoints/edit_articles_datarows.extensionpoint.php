<?php

$GLOBALS['plugin']->edit_article_datarows = array();
function xt_ch_iframe_snode_lexikon_contribute_edit_articles_datarows($args){
    $GLOBALS['plugin']->edit_article_datarows[] = array("label" => $args[0], "input"=> $args[1]);
}

function xt_ch_iframe_snode_lexikon_build_edit_articles_datarows(){
    XT::assign("EDIT_ARTICLE_DATAROWS", $GLOBALS['plugin']->edit_article_datarows);

}

?>
