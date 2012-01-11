<?php
class XT_Image {

	var $versions = array();

	var $plugin;
	var $nestedSet;
	var $doEffects;
	var $versioneffects;
	var $quality = 100;

	function XT_Image(&$plugin){
		$this->plugin = &$plugin;
	}

	function create(){

	}


	function createPseudoOriginal($file,$maxFileSize,$OriginalImageWidth){
		if (ceil((filesize($file) / (1024))) > $maxFileSize){
			$info = getimagesize($file);
			if ($info[0] > $OriginalImageWidth) {
				switch($info[2]){
					case 1:
						$image = imagecreatefromgif($file);
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
				$size[0] = $OriginalImageWidth;
				$size[1] = 1;
				$image = doEffect_scale($image,$file,$size	);
				switch($info[2]){
					case 1:
						imagejpeg($image, $file);
						break;
					case 2:
						imagejpeg($image, $file);
						break;
					case 3:
						imagepng($image, $file);
						break;
				}
			}
		}
	}

	function createCube($srcfile){

		$file = $srcfile . "_2";
		$info = getimagesize($file);

		switch($info[2]){
			case 1:
				$image = imagecreatefromgif($file);
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

		if($image){

			$im = imagecreatetruecolor(80,80);

			if($info[0] > $info[1]){
				imagecopyresampled($im,$image,0,0,$info[0]/2-$info[1]/2,0,80,80,$info[1],$info[1]);
			} else {
				imagecopyresampled($im,$image,0,0,0,$info[1]/2-$info[0]/2,80,80,$info[0],$info[0]);
			}

			switch($info[2]){
				case 1:
					imagejpeg($im, $srcfile . "_cube",100);
					break;
				case 2:
					imagejpeg($im, $srcfile . "_cube",100);
					break;
				case 3:
					imagepng($im, $srcfile . "_cube",9);
					break;
			}
			imagedestroy($im);
			imagedestroy($image);
		}
	}

	function createVersion($file, $version, $targetfile, $quality = 100){

		$info = array();

		if(array_key_exists($version, $this->versions)){
			$info = getimagesize($file);
			switch($info[2]){
				case 1:
					$image = imagecreatefromgif($file);
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
				foreach($this->versioneffects[$version] as $key => $value){
					$image = $this->doEffect(&$image, $file, $value);
				}
				switch($info[2]){
					case 1:
						imagejpeg($image, $targetfile, $quality);
						break;
					case 2:
						imagejpeg($image, $targetfile, $quality);
						break;
					case 3:
						imagesavealpha($image,true);
						imagepng($image, $targetfile,intval($quality/10)-1);
						break;
				}

				// private effects
				if(is_array($this->privateversioneffects[$version])){
					foreach($this->privateversioneffects[$version] as $key => $value){
						$this->doPrivateEffect($targetfile, $value,$info);
					}
				}

				$filesize = filesize($targetfile);
				$img_info = getimagesize($targetfile);

				/**
                 * Build info array
                 */
				$info = array(
				"filesize" => $filesize,
				"width" => $img_info[0],
				"height" => $img_info[1],
				"type" => $img_info[2]
				);
			} else {
				XT::log("File format not supported",__FILE__,__LINE__,XT_ERROR);
			}
		}

		return $info;

	}

	function doPrivateEffect(){
		$argv = func_get_args();
		$effect = $argv[1]['name'];
		if(is_file(CLASS_DIR . 'image/effects/gd2/' . $effect . '.effect.' . 'gd2' . '.php')){
			include_once(CLASS_DIR . 'image/effects/gd2/' . $effect . '.effect.' . 'gd2' . '.php');
			if(function_exists('doEffect_' . $effect)){
				return call_user_func_array('doEffect_' . $effect, array($argv[0], $argv[1]['param'],$argv[2]));
			}
		}
	}


	function doEffect(){
		$argv = func_get_args();
		$effect = $argv[2]['name'];
		if(is_file(CLASS_DIR . 'image/effects/gd2/' . $effect . '.effect.' . 'gd2' . '.php')){
			include_once(CLASS_DIR . 'image/effects/gd2/' . $effect . '.effect.' . 'gd2' . '.php');
			if(function_exists('doEffect_' . $effect)){
				return call_user_func_array('doEffect_' . $effect, array(&$argv[0], $argv[1], $argv[2]['params']));
			}
		}
	}

	function doAfterEffect(){
		$argv = func_get_args();
		$id = $argv[0];
		$effect = $argv[1];
		array_shift($argv);
		array_shift($argv);

		if(is_file(PIC_DIR . $id)){
			$image = imagecreatefromjpeg(PIC_DIR . $id);
			$image = &$this->doEffect(&$image, PIC_DIR . $id, array('name' => $effect, 'params' => $argv));
			imagejpeg($image, PIC_DIR . $id, $this->quality);
		}
	}

	function setNestedSet(&$nestedSet){
		$this->nestedSet = &$nestedSet;
	}

	function addVersion($id, $name, $width, $height, $crop = false, $background_color = "FFFFFF"){

		$this->versions[$name]['id'] = $id;
		$this->versions[$name]['name'] = $name;
		$this->versions[$name]['width'] = $width;
		$this->versions[$name]['height'] = $height;
		 $this->versions[$name]['default'] = false;
		$this->versions[$name]['background_color'] = $background_color;

		if($width != -1 && $height != -1){
			if($crop){
				$this->addEffectToVersion($name, 'crop', $width, $height,$background_color);
			}else {
				$this->addEffectToVersion($name, 'scale', $width, $height,$background_color);
			}
		}
	}

	function addEffectToVersion(){

		// Get all arguments
		$argv = func_get_args();

		// Get version name
		$versionname = $argv[0];

		// Extract version and effectname from params
		$this->versioneffects[$versionname][]['name'] = $argv[1];

		// Shift the param array TWO times
		array_shift($argv);
		array_shift($argv);

		// Define the rest of the array as params for the effect
		$this->versioneffects[$versionname][count($this->versioneffects[$versionname])-1]['params'] = $argv;

	}

	function addPrivateEffectToVersion($version,$effect,$param){
		$this->privateversioneffects[$version][] = array('name' => $effect, 'param' => $param);

	}

	function getEffectsByVersion($version){
		return $this->versioneffects;
	}

	function getVersions(){
		return $this->versions;
	}

	function addImage($dest){

		$id = $this->nestedSet->insertNodeAtEnd($target_id, $title);

		/*
		if($id % $this->plugin->getConfig('imageSetsPerFolder') < $this->plugin->getConfig('imageSetsPerFolder')){
		mkdir(PIC_DIR . 'originals/' . );
		}
		move_uploaded_file($_FILES["file"]["tmp_name"], PIC_DIR . 'originals/' .
		*/

	}
}

?>