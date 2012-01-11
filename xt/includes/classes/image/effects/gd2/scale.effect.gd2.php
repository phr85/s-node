<?php

/**
 * Scales an image using gd2 with resampling
 *
 * resource dst_image, resource src_image, int dst_w, int dst_h
 *
 * dst_image    Destination Image
 * src_image    Source Image
 * dst_w        Destination Image Width
 * dst_h        Destination Image Height
 */

function doEffect_scale($img_object, $file, $args){

	$pref_width = $args[0];
	$pref_height = $args[1];
	$background_color = hexrgb("0x" . $args[2]);

	$size = getimagesize($file);
	$width = $size[0];
	$height = $size[1];

	/**
     * calculate new width and height
     */
	if($width > $pref_width && $pref_height==1){
		$new_height = ceil($height * $pref_width / $width);
		$new_image = imagecreatetruecolor($pref_width, $new_height);
		$farbe   = ImageColorAllocate ($new_image, $background_color['red'], $background_color['green'], $background_color['blue']);
		imagefill($new_image,0,0,$farbe);
		setTransparency($new_image,$img_object);
		imagecopyresampled($new_image, $img_object,0, 0, 0, 0, $pref_width, $new_height, $size[0], $size[1]);
		return $new_image;
	}

	if($height > $pref_height && $pref_width==1){
		$new_width  = ceil($width * ($pref_height / $height));
		$new_image = imagecreatetruecolor($new_width, $pref_height);
		$farbe   = ImageColorAllocate ($new_image, $background_color['red'], $background_color['green'], $background_color['blue']);
		imagefill($new_image,0,0,$farbe);
		setTransparency($new_image,$img_object);
		imagecopyresampled($new_image, $img_object, 0, 0, 0, 0, $new_width, $pref_height, $size[0], $size[1]);
		return $new_image;
	}

	if($pref_width!=1 && $pref_height!=1){

		$new_image = imagecreatetruecolor($pref_width, $pref_height);
		$farbe   = ImageColorAllocate ($new_image, $background_color['red'], $background_color['green'], $background_color['blue']);
		imagefill($new_image,0,0,$farbe);

		// original im querformat
		$src_ratio = $size[0] / $size[1];
		$target_ratio = $pref_width / $pref_height;
		// anhand seitenverhaeltniss groesse rechnen
		if($target_ratio < $src_ratio){
			$src_h_tmp = floor($pref_width / $src_ratio);
			$src_y = floor( ($pref_height - ($pref_width / $src_ratio)) / 2);
			// tempbild
			$tmp_image = imagecreatetruecolor($pref_width, $src_h_tmp);
			imagealphablending($tmp_image, false);
			imagesavealpha($tmp_image, true);
			imagecopyresampled($tmp_image,$img_object,0,0,0,0 ,$pref_width,$src_h_tmp,$size[0],$size[1]);
			imagecopy($new_image,$tmp_image,0,$src_y,0,0,$pref_width ,$src_h_tmp);
			imagecolortransparent($new_image, $farbe);
			imagealphablending($new_image, false);
			imagesavealpha($new_image, true);

		}else{
			$src_w_tmp = floor($src_ratio * $pref_height);
			$src_x = floor( ($pref_width - ($src_ratio * $pref_height)) / 2);
			// tempbild
			$tmp_image = imagecreatetruecolor($src_w_tmp, $pref_height);
			imagealphablending($tmp_image, false);
			imagesavealpha($tmp_image, true);
			imagecopyresampled($tmp_image,$img_object,0,0,0,0 ,$src_w_tmp,$pref_height,$size[0],$size[1]);
			imagecolortransparent($new_image,$farbe );
			imagealphablending($new_image, false);
			imagesavealpha($new_image, true);
			imagecopy($new_image,$tmp_image,$src_x,0,0,0,$src_w_tmp ,$pref_height);
		}
		//imagefill($new_image,0,0,$farbe);
		return $new_image;
	}

	return $img_object;
}

function hexrgb ($hexstr)
{
	$int = hexdec($hexstr);

	return array("red" => 0xFF & ($int >> 0x10),
	"green" => 0xFF & ($int >> 0x8),
	"blue" => 0xFF & $int);
}

function setTransparency($new_image,$image_source)
    {
            $transparencyIndex = imagecolortransparent($image_source,array('red' => 255, 'green' => 255, 'blue' => 255));
            $transparencyColor = array('red' => 255, 'green' => 255, 'blue' => 255);
            if ($transparencyIndex >= 0) {
                $transparencyColor    = imagecolorsforindex($image_source, $transparencyIndex);   
            }
            
            $transparencyIndex    = imagecolorallocate($new_image, $transparencyColor['red'], $transparencyColor['green'], $transparencyColor['blue']);
            imagefill($new_image, 0, 0, $transparencyIndex);
            imagecolortransparent($new_image, $transparencyIndex);
       imagealphablending($new_image, false);
		imagesavealpha($new_image,true);
    } 
?>