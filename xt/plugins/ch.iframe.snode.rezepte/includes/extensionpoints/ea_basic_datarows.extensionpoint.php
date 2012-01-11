<?php
function xt_ch_iframe_snode_rezepte_contribute_ea_basic_datarows($args){
    $GLOBALS['plugin']->edit_recipe_datarows[] = $args[0];
}

function xt_ch_iframe_snode_rezepte_build_ea_basic_datarows(){
    foreach ($GLOBALS['plugin']->edit_recipe_datarows as $contrib){
        $ea_basic_datarows .= $contrib;
    }
    XT::assign("EA_BASIC_DATAROWS", $ea_basic_datarows);

}
?>
