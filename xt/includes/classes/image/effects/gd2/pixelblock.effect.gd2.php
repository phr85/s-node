<?php

function doEffect_pixelblock($file,$param,$info){
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
        
        $blocksize = $param['blocksize'];
        if($blocksize < 2){
            $blocksize = 15;
        }

        for ($x = 0; $x < $imagex; $x += $blocksize) {
            for ($y = 0; $y < $imagey; $y += $blocksize) {
                // get the pixel colour at the top-left of the square
                $thiscol = imagecolorat($image, $x, $y);

                // set the new red, green, and blue values to 0
                $newr = 0;
                $newg = 0;
                $newb = 0;

                // create an empty array for the colours
                $colours = array();

                // cycle through each pixel in the block
                for ($k = $x; $k < $x + $blocksize; ++$k) {
                    for ($l = $y; $l < $y + $blocksize; ++$l) {
                        // if we are outside the valid bounds of the image, use a safe colour
                        if ($k < 0) { $colours[] = $thiscol; continue; }
                        if ($k >= $imagex) { $colours[] = $thiscol; continue; }
                        if ($l < 0) { $colours[] = $thiscol; continue; }
                        if ($l >= $imagey) { $colours[] = $thiscol; continue; }

                        // if not outside the image bounds, get the colour at this pixel
                        $colours[] = imagecolorat($image, $k, $l);
                    }
                }

                // cycle through all the colours we can use for sampling
                foreach($colours as $colour) {
                    // add their red, green, and blue values to our master numbers
                    $newr += ($colour >> 16) & 0xFF;
                    $newg += ($colour >> 8) & 0xFF;
                    $newb += $colour & 0xFF;
                }

                // now divide the master numbers by the number of valid samples to get an average
                $numelements = count($colours);
                $newr /= $numelements;
                $newg /= $numelements;
                $newb /= $numelements;

                // and use the new numbers as our colour
                $newcol = imagecolorallocate($image, $newr, $newg, $newb);
                imagefilledrectangle($image, $x, $y, $x + $blocksize - 1, $y + $blocksize - 1, $newcol);
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