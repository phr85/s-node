<?php

/**
 * Scales an image using imagick
 * 
 * image, width, height, geometry
 * Example: doEffect_scale($img_object, 200, 100, "!");
 */
function doEffect_scale($img_object, $args){
    
    if(!imagick_scale($img_object->img, $args[1], $args[2], $args[3])){
        return false;        
    }
    return true;
       
}

?>