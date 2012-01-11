<?
if (!function_exists("htmlspecialchars_decode")) {
    function htmlspecialchars_decode($string, $quote_style = ENT_COMPAT) {
        return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
    }
}
class text2image {
    var $font = 'chalkboard.ttf'; //default font. put in full path.
    var $fontdir = FONT_DIR;
    var $msg = "undefined"; // default text to display.
    var $size = 20;
    var $rot = 0; // rotation in degrees.
    var $pad = 0; // padding.
    var $pad_ver = 0; // ver padding.
    var $pad_hor = 0; // hor padding.
    var $pad_top = 0;
    var $pad_right= 0;
    var $pad_bottom = 0;
    var $pad_left = 0;
    var $transparent = 0; // transparency set to on.
    var $red = 0; // white text...
    var $grn = 0;
    var $blu = 0;
    var $bg_red = 255; // on black background.
    var $bg_grn = 255;
    var $bg_blu = 255;
    var $imagedir = '';
    var $filetype = 'png';
    var $filename = 'undefined.png';
    var $fontlocation;
    var $cache = 1;
    var $letterspace = 100;
    var $image_width;
    var $image_height;

    function text2image(){
        $this->imagedir = BASE_DIR . IMAGE_DIR . 'txt/';
    }
    function draw() {
        // Set a padding around the if pad is set
        if ($this->pad > 0) {
			$this->pad_hor = $this->pad_hor  + $this->pad;
			$this->pad_ver = $this->pad_ver  + $this->pad;
		}

        // Themed font? Take the themed font instead of the default font
        if (is_file($this->fontdir . $GLOBALS['cfg']->get("system","theme") . "/" . $this->font  )) {
            $this->fontlocation = $this->fontdir . $GLOBALS['cfg']->get("system","theme") . "/" . $this->font;
        } else {
            $this->fontlocation = $this->fontdir . $this->font;
        }

		// Create an unique filename
        $this->filename = md5($this->letterspace . $this->msg . $this->size . $this->rot . $this->pad . $this->pad_top . $this->pad_right . $this->pad_bottom . $this->pad_left . $this->pad_hor . $this->pad_ver .$this->transparent . $this->red . $this->grn .$this->blu . $this->bg_red . $this->bg_grn .$this->bg_blu . $this->font) . '.' . $this->filetype;

        // Start calculating the image if it doesn't exist or if it shouldn't cached
        if(!file_exists($this->imagedir . $this->filename) OR $this->cache == 0){

			// Repkace newlines and !!N to !!n because of splitt it later in array for multiline text
            $this->msg = str_replace("\r","!!n",$this->msg);
            $this->msg = str_replace("!!N","!!n",$this->msg);
			//Decode html special chars
            $this->msg = htmlspecialchars_decode($this->msg,ENT_QUOTES);

			// Make an array for each new line marked with !!n
            $msgs = explode("!!n",$this->msg);
            // Count the number of lines
            $numberOfLines = count($msgs);
            if ($numberOfLines == 0) {
                $numberOfLines = 1;
            }

            // Reset major variables
            $width = 0;
            $height = 0;
            $offset_x = 0;
            $offset_y = 0;
            $bounds = array();
            $image = "";
            $tmpwidth = 0;
            $tmpheight = 0;
            $tmpoffset_y = 0;
            $tmpoffset_x = 0;

           // determine font height.
            $bounds = ImageTTFBBox($this->size, $this->rot, $this->fontlocation , "Â");
			// calculate the font height if a rotation is set
			// Rotation doesn't work well enough
            if ($this->rot < 0) {
                $startyoffset = abs($bounds[7]-$bounds[1]);
            } else if ($this->rot > 0) {
                $startyoffset = abs($bounds[1]-$bounds[7]) ;
            } else {
                $startyoffset = abs($bounds[7]-$bounds[1]) ;
            }

            // determine font height.
            $bounds = ImageTTFBBox($this->size, $this->rot, $this->fontlocation , "Âg");
			// calculate the font height if a rotation is set
			// Rotation doesn't work well enough
            if ($this->rot < 0) {
                $font_height = abs($bounds[7]-$bounds[1]);
            } else if ($this->rot > 0) {
                $font_height = abs($bounds[1]-$bounds[7]) ;
            } else {
                $font_height = abs($bounds[7]-$bounds[1]) ;
            }

            // determine bounding box.
            foreach ($msgs as $msg) {
                // determine font height.
                $bounds = ImageTTFBBox($this->size, $this->rot, $this->fontlocation , $msg);
                // Rotation doesn't work well enough
                if ($this->rot < 0) {
                    $tmpwidth = (abs($bounds[4]-$bounds[0])) * $this->letterspace / 100;
                    $tmpheight = abs($bounds[3]-$bounds[7]);
                    $tmpoffset_y = $startyoffset;
                    $tmpoffset_x = 0;

                } else if ($this->rot > 0) {
                    $tmpwidth = (abs($bounds[2]-$bounds[6])) * $this->letterspace / 100;
                    $tmpheight = abs($bounds[1]-$bounds[5]);
                    $tmpoffset_y = abs($bounds[7]-$bounds[5])+$startyoffset;
                    $tmpoffset_x = abs($bounds[0]-$bounds[6]);

                } else {
                    $tmpwidth = (abs($bounds[4]-$bounds[6])) * $this->letterspace / 100;
                    $tmpheight = abs($bounds[7]-$bounds[1]);
                    $tmpoffset_y = $startyoffset;
                    $tmpoffset_x = 0;
                }
                $tmpwidth  > $width      ? $width    = $tmpwidth    : null;
                $tmpheight > $height     ? $height   = $tmpheight   : null;
                $tmpoffset_y > $offset_y ? $offset_y = $tmpoffset_y : null;
                $tmpoffset_x > $offset_x ? $offset_x = $tmpoffset_x : null;
            }
            
            $this->image_width = $width+($this->pad_hor*2)+$this->pad_left+$this->pad_right+1;
            $this->image_height = abs((($font_height  * $numberOfLines )+($this->pad_ver*2))) + ($this->pad_top)+ ($this->pad_bottom);
            $image = imagecreate($this->image_width,$this->image_height);

            $background = ImageColorAllocate($image, $this->bg_red, $this->bg_grn, $this->bg_blu);
            $foreground = ImageColorAllocate($image, $this->red, $this->grn, $this->blu);

            if ($this->transparent) ImageColorTransparent($image, $background);
            ImageInterlace($image, false);

            // render it.
            // ImageTTFText($image, $this->size, $this->rot, 0+($this->pad_hor), $font_height+($this->pad_ver) , $foreground, $this->fontlocation , $this->msg);
            $i = 1;
            foreach ($msgs as $msg) {
                $posx= $this->pad_left; + $this->pad_hor;
                if($this->rot != 0){
                    ImageTTFText($image, $this->size, $this->rot, $posx, ($offset_y*$i+($this->pad_ver)) , $foreground, $this->fontlocation , $msg);
                }else{

                    $len = strlen(utf8_decode($msg));
                    $totalwidth = ImageTTFBBox($this->size, $this->rot, $this->fontlocation ,$msg);
                    if ($len == 0){ $len = "0.0000001";}
                    $distance = intval( (($totalwidth[2] * $this->letterspace/100) - $totalwidth[2]) /$len );
                    for($buchstabe = 0; $buchstabe<$len; $buchstabe++){
                        $positionen = ImageTTFBBox($this->size, $this->rot, $this->fontlocation , mb_substr($msg,$buchstabe,1,"UTF-8"));
                        ImageTTFText($image, $this->size, $this->rot, $posx, ($offset_y*$i+($this->pad_ver)) + ($i * $this->pad_bottom - $this->pad_bottom)  + ($i * $this->pad_top) , $foreground, $this->fontlocation , mb_substr($msg,$buchstabe,1,"UTF-8"));
                        $posx += $positionen[2] + $distance;
                    }
                }
                $i++;
            }
            // output PNG object.
            switch ($this->filetype) {
                case 'png':
                    imagePNG($image, $this->imagedir . $this->filename);
                    break;
                case 'gif':
                    imagegif($image, $this->imagedir . $this->filename);
                    break;
                case 'jpg':
                    imagejpeg($image, $this->imagedir . $this->filename);
                    break;
                default:
                    imagePNG($image, $this->imagedir . $this->filename);
                    break;
            }
        }
        else {
            $image_dimensions = getimagesize($this->imagedir . $this->filename);
            $this->image_width = $image_dimensions[0];
            $this->image_height = $image_dimensions[1];
        }
    }
}

?>