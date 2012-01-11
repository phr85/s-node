<?php
/**
 * S-Node XT Captcha
 * 
 * Description
 * ===========
 * The captchaclass generates an image with a code.
 * That code will be saved in a session variable as md5 sum with the name captchaxt.
 * After displaying the image, you'll be able to compare the session code with a post
 * value.
 * 
 * Example of image generating
 * =====================================================
 * <?php
 * header("Content-type: image/jpeg");
 * require_once('xt/includes/classes/captchaxt.class.php');
 * $myCaptcha = new captchaxt();
 * $myCaptcha->getrandrom();
 * $myCaptcha->generateImage();
 * $myCaptcha->displayImage();
 * ?>
 * 
 * Compare the post value with the session value
 * =============================================
 * if ($_SESSION['captchaxt'] == md5(strtoupper($GLOBALS['plugin']->getPostValue('code')))){
 * Please note that the generated characters are uppercase. The md5 is case sensitive.
 * So you have to run the comparison with strtoupper($str).
 * 
 * @author Markus Graf <mgraf@iframe.ch>
 * @version $Id$
 * @package S-Node
 * @subpackage Core
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 */
class captchaxt {
	
	/**
	 * Displayed code
	 *
	 * @var string 
	 */
	var $code = "";
	
	/**
	 * md5 code
	 *
	 * @var string 
	 */
	var $codeMD5 = "";
	
	/**
	 * The lenght of  the code
	 *
	 * @var int 
	 */
	var $lenght = 4;
	
	/**
	 * Image width
	 *
	 * @var int 
	 */
	var $width = 150;

	/**
	 * Image height
	 *
	 * @var int 
	 */
	var $height = 50;
	
	/**
	 * The image ressource
	 *
	 * @var object 
	 */
	var $img;
	
	/**
	 * Set style of the image
	 * 0 = bright
	 * 1 = dark
	 * 2 = grayscall
	 * @var int
	 */
	var $style = 2;
	
	/**
	 * Set the name of the captcha to intergrate multible captchas in one site
	 * @var string
	 */
	var $name = "captchaxt";
	
	/**
	 * Generate a random string
	 */
	function getrandrom(){
		// Available characters
		$AvailableChars = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z','1','2','3','4','5','6','7','8','9','!','?','+','=');
		//generate the code
		for ($i = 0;$i <= ($this->lenght - 1); $i++){
			$this->code .= $AvailableChars[rand(0,(sizeof($AvailableChars)-1))];
		}
		$this->codeMD5 = md5(strtoupper($this->code));
		session_write_close();
		session_start();
		$_SESSION[$this->name] = $this->codeMD5;
		session_write_close();
		session_start();
	}

	/**
	* Generate the image object 
	*/
	function generateImage() {
		// Generate a new image
		$this->img = imagecreatetruecolor( $this->width, $this->height );
		imagealphablending($this->img , 1);
		// Create a background to obfuscate the image

		if ($this->style == 0 || $this->style == 2) {
			$minValue = 127;
			$maxValue = 255;
			imagefill($this->img,0,0,imagecolorallocate( $this->img , 255, 255, 255 ));
		} else {
			$minValue = 0;
			$maxValue = 100;
			imagefill($this->img,0,0,imagecolorallocate( $this->img , 0, 0, 0 ));
		}
		for ($i = 0; $i <=100; $i++ ){	
			
			$r = round( rand( $minValue, $maxValue ) );
			$g = round( rand( $minValue, $maxValue ) );
			$b = round( rand( $minValue, $maxValue ) );
			$color = imagecolorallocate( $this->img , $r, $g, $b );
			$x1 = round(rand(0,$this->width));
			$y1 = round(rand(0,$this->height));
			$x2 = round(rand($x1,$this->width));
			$y2=  round(rand($y1,$this->height));
			imagefilledrectangle( $this->img ,$x1, $y1, $x2,$y2, $color );			
		}
		
		
		
		// calculate sizes
		$start_x = round($this->width / strlen($this->code));
		$max_font_size = $start_x;
		$start_x = round(0.5*$start_x);
		$max_x_ofs = round($max_font_size*0.9);
		// Insert the text string
		for ($i=0;$i <= strlen($this->code);$i++)
			{
				if ($this->style == 0 || $this->style == 2) {
					$minValue = 0;
					$maxValue = 100;
				} else {
					$minValue = 127;
					$maxValue = 255;
				}
				$r = round( rand( $minValue, $maxValue ) );
				$g = round( rand( $minValue, $maxValue ) );
				$b = round( rand( $minValue, $maxValue ) );
				$y_pos = ($this->height/2)+round( rand( 5, 20 ) );
				// Adjust the font size
				$fontsize = round( rand( 18, $max_font_size) );
				$color = imagecolorallocate( $this->img , $r, $g, $b);
				$presign = round( rand( 0, 1 ) );
				// Adjust the angle
				$angle = round( rand( 0, 25 ) );
				if ($presign==true) $angle = -1*$angle;
				
				imagefttext( $this->img , $fontsize, $angle, $start_x+$i*$max_x_ofs, $y_pos, $color, FONT_DIR . 'chalkboard.ttf', substr($this->code,$i,1));
			}
	}
	/**
	 * Displays the image.
	 * Don't forget to set the header to tell the browser the content type:
	 * header("Content-type: image/jpeg");
	 *
	 */
	function displayImage() {
		if (is_null($this->img)){
			$this->generateImage();
		}
		
		if ($this->style == 2) {
			$this->imageToGreyscale();
		}
		//if ($this->img )
		imagejpeg($this->img,'',100);
	}
	
	function imageToGreyscale() {
	   $dstImg = $this->img;
	   $imgW = imagesx( $dstImg );
	   $imgH = imagesy( $dstImg );
	
	   for($y=0;$y<$imgH;$y++)
	   {
	      for($x=0;$x<$imgW;$x++)
	      {
	         $dstRGB = imagecolorat($dstImg, $x, $y);
	
	         //$dstA = ($dstRGB >> 24) << 1;
	         $dstR = $dstRGB >> 16 & 0xFF;
	         $dstG = $dstRGB >> 8 & 0xFF;
	         $dstB = $dstRGB & 0xFF;
	
	         $newC = ( $dstR + $dstG + $dstB )/3;
	
	         $newRGB = imagecolorallocate($dstImg, $newC, $newC, $newC );
	         imagesetpixel($dstImg, $x, $y, $newRGB );
	      }
	   }
	} 
	
	function setName($name){
		$this->name = $name;
	}
}
?>