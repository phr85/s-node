<?php
function xt_ch_iframe_snode_lexikon_contribute_ea_basic_datarows($args){
    $GLOBALS['plugin']->edit_article_datarows[] = $args[0];
}

function xt_ch_iframe_snode_lexikon_build_ea_basic_datarows(){
    foreach ($GLOBALS['plugin']->edit_article_datarows as $contrib){
        $ea_basic_datarows .= $contrib;
    }
    XT::assign("EA_BASIC_DATAROWS", $ea_basic_datarows);

}
?>
