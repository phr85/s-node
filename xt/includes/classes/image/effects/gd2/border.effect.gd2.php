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

function doEffect_border($file,$params,$info){
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

        if ($params["width"])
        $t = $params["width"];
        else
        $t = 1; // default border

        $w = imagesx($image); $h = imagesy($image);

        if ($params["enlarge"]) {
            $im = imagecreatetruecolor($w+2*$t, $h+2*$t);
            imagecopy($im, $image, $t, $t, 0, 0, $w, $h);
            imagedestroy($image);
            $image =& $im;
            $w += 2*$t;
            $h += 2*$t;
        }

        if ($params["color"]) {
            if (is_array($params["color"]))
            list($r, $g, $b) = $params["color"];
            else
            list($r, $g, $b) = htmlcolor2rgb($params["color"]);
            $col = imagecolorallocate($image, $r, $g, $b);
        } else
        $col = imagecolorallocate($image, 0, 0, 0); // black border = default

        for ($i=0; $i<$t; $i++) {
            imagerectangle($image, $i, $i, $w-1-$i, $h-1-$i, $col);
        }


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