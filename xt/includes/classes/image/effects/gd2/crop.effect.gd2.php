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

function doEffect_crop($img_object, $file, $args){

	$pref_width = $args[0];
	$pref_height = $args[1];
	$background_color = hexrgb("0x" . $args[2]);

	$size = getimagesize($file);
	$width = $size[0];
	$height = $size[1];

	$source_ratio = $width / $height;
	
	/**
     * calculate new width and height
     */
	if($width > $pref_width && $pref_height==1){
		$new_height = $height * ($pref_width / $width);
		$new_image = imagecreatetruecolor($pref_width, $new_height);

		$farbe   = ImageColorAllocate ($new_image,$background_color['red'], $background_color['green'], $background_color['blue']);
		imagefill($new_image,0,0,$farbe);
		imagecopyresampled($new_image, $img_object,0, 0, 0, 0, $pref_width, round($new_height), $size[0], $size[1]);
		return $new_image;
	}

	if($height > $pref_height && $pref_width==1){
		$new_width  = round($width * ($pref_height / $height));
		$new_image = imagecreatetruecolor($new_width, $pref_height);
		$farbe   = ImageColorAllocate ($new_image, $background_color['red'], $background_color['green'], $background_color['blue']);
		imagefill($new_image,0,0,$farbe);
		imagecopyresampled($new_image, $img_object, 0, 0, 0, 0, $new_width, $pref_height, $size[0], $size[1]);
		return $new_image;
	}

	if($pref_width!=1 && $pref_height!=1){
		
		$new_image = imagecreatetruecolor($pref_width, $pref_height);
		$farbe   = ImageColorAllocate ($new_image, $background_color['red'], $background_color['green'], $background_color['blue']);
		imagefill($new_image,0,0,$farbe);

		
		$source_ratio = $size[0] / $size[1];
		$target_ratio = $pref_width / $pref_height;
		
		
		// wenn sourceratio grösser targetratio, dann zentriere X-axis 
		// wenn sourceratio kleiner targetratio, dann zentriere Y-axis
		if($source_ratio < $target_ratio){
			// dann zentriere Y-axis
			// x-axis ist fixe grösse
		    $temp_height = $pref_width / $source_ratio;
		 	$temp_width = $pref_width; 
		    
			// mittlere verschiebung rechnen
		    $verschiebung = floor( ($pref_height - ($pref_width / $source_ratio)) / 2);
			
			// tempbild
			imagecopyresampled($new_image,$img_object,0,$verschiebung,0,0,$temp_width,$temp_height,$size[0],$size[1]);
			imagecolortransparent($new_image, $farbe);

		}else{
			 // dann zentriere Y-axis
			// x-axis ist fixe grösse
		    $temp_height = $pref_height;
		 	$temp_width = $pref_height * $source_ratio; 
		    
			// mittlere verschiebung rechnen
		    $verschiebung = floor( ($pref_width - ($pref_height * $source_ratio)) / 2);
			
			// tempbild
			imagecopyresampled($new_image,$img_object,$verschiebung,0,0,0,$temp_width,$temp_height,$size[0],$size[1]);
			imagecolortransparent($new_image, $farbe);
		}
		//imagefill($new_image,0,0,$farbe);
		return $new_image;
	}

	return $img_object;
}
 
?>