<?php

if(!function_exists('htmlcolor2rgb')){
    function htmlcolor2rgb($htmlcol) {
        $offset = 0;
        if ($htmlcol{0}=='#') $offset = 1;
        $r = hexdec(substr($htmlcol, $offset, 2));
        $g = hexdec(substr($htmlcol, $offset+2, 2));
        $b = hexdec(substr($htmlcol, $offset+4, 2));
        return array($r, $g, $b);
    }
}


function doEffect_video($file,$param,$info){
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
        //------------

      // nofx, just save as jpg
 
        //--------------------
        imagejpeg($image, $file, 100);
    }
}

?>