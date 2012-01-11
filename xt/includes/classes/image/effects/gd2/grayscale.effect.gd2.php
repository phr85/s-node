<?php

function doEffect_grayscale($file,$param,$info){
    switch($info[2]){
        case 1:
        // weil das bild vom system schon in ein jpg gewandelt wurde
        $image = imagecreatefromjpeg($file);
        break;
        case 2:
        $image = imagecreatefromjpeg($file);
        break;
        case 3:
        $image = imagecreatefrompng($file);
        break;
        case 4:
        // Flash File
        break;
    }
    if($info[2] > 0 && $info[2] < 4){
        //-----
        $w = imagesx($image);
        $h = imagesy($image);
        for($i=0; $i<$h; $i++) {
            for($j=0; $j<$w; $j++) {
                $pos = imagecolorat($image, $j, $i);
                if (!imageistruecolor($image)) {
                    $f = imagecolorsforindex($image, $pos);
                    $gst = $f["red"]*0.15 + $f["green"]*0.5 + $f["blue"]*0.35;
                    $col = imagecolorexact($image, $gst, $gst, $gst);
                    if ($col = -1) $col = imagecolorallocate($image, $gst, $gst, $gst);
                } else {
                    $gst = (($pos>>16)&0xFF)*0.15 + (($pos>>8)&0xFF)*0.5 + ($pos&0xFF)*0.35;
                    $col = imagecolorallocate($image, $gst, $gst, $gst);
                }
                imagesetpixel($image, $j, $i, $col);
            }
        }
        //--------------------
 
            imagepng($image, $file);
    }
}

?>