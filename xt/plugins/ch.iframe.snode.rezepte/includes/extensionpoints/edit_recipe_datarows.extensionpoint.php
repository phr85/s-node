<?php

$GLOBALS['plugin']->edit_recipe_datarows = array();
function xt_ch_iframe_snode_rezepte_contribute_edit_recipe_datarows($args){
    $GLOBALS['plugin']->edit_recipe_datarows[] = array("label" => $args[0], "input"=> $args[1]);
}

function xt_ch_iframe_snode_rezepte_build_edit_recipe_datarows(){
    XT::assign("EDIT_RECIPE_DATAROWS", $GLOBALS['plugin']->edit_recipe_datarows);

}

?>
