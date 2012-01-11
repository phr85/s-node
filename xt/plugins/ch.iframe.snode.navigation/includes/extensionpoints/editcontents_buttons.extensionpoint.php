<?php
function xt_ch_iframe_snode_navigation_contribute_editcontents_buttons(){
    $args = func_get_args();
    $args = $args[0];
    XT::addImageButton($args[0],$args[1],'editcontents_buttons',$args[2],$args[3],$args[4],$args[5],$args[6],$args[7]);
}

function xt_ch_iframe_snode_navigation_build_editcontents_buttons(){
    XT::assign("EDITCONTENTS_BUTTONS", $GLOBALS['plugin']->getButtons('editcontents_buttons'));
}

?>
