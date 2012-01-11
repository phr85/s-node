<?php

function doEffect_scatter($file,$param,$info){
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
//------------------
    $imagex = imagesx($image);
    $imagey = imagesy($image);

    for ($x = 0; $x < $imagex; ++$x) {
        for ($y = 0; $y < $imagey; ++$y) {
            $distx = rand(-$param['distx'], $param['distx']);
            $disty = rand(-$param['disty'], $param['disty']);

            if ($x + $distx >= $imagex) continue;
            if ($x + $distx < 0) continue;
            if ($y + $disty >= $imagey) continue;
            if ($y + $disty < 0) continue;

            $oldcol = imagecolorat($image, $x, $y);
            $newcol = imagecolorat($image, $x + $distx, $y + $disty);
            imagesetpixel($image, $x, $y, $newcol);
            imagesetpixel($image, $x + $distx, $y + $disty, $oldcol);
        }
    }
        
        //_-----------------
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