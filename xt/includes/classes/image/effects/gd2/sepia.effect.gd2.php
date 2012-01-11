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

function doEffect_sepia($file,$params,$info){
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

        // greyscale image
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

        // settings for sepia
        $color = "#FEA222";
        $alpha = 80;

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

   
        imagepng($image, $file);
         
    }

}

?>