<?php
//from http://opensource.eyefi.nl/eyefi-imgfilter/border.html
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

function doEffect_colorize($file,$params,$info){
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
        //---------------

        $color = $params["color"];
        $alpha = $params["alpha"];
        if(empty($color)) {
            $color = "#646464";
        }
        if(is_null($alpha)) {
            $alpha = 50;
        }

        $alpha = $alpha * (127 / 100);
        $carr = htmlcolor2rgb($color);
        $w = imagesx($image); $h = imagesy($image);

        imagealphablending($image, true);
        if(function_exists("imagecolorallocatealpha")) {
            $colorres = imagecolorallocatealpha($image, $carr[0], $carr[1], $carr[2], $alpha);
        } else {
            $colorres = imagecolorallocate($image, $carr[0], $carr[1], $carr[2]);
        }

        imagefilledrectangle($image, 0, 0, $w-1, $h-1, $colorres);

 
        //------------

        // write image
        switch($info[2]){
            case 1:
            imagejpeg($image, $file, 100);
            break;
            case 2:
            imagejpeg($image, $file, 100);
            break;
            case 3:
            imagepng($image, $file);
            break;
        }

    }

}

?>