<?php

//setzt ein Bit des Wertes auf true, $val = die zahl die for dem addieren dieses Bits vorhanden ist (zb. 533), $bit = (1-255)
function addbit($val, $bit) {
   if (getbit($val, $bit)) return $val;
   return $val += '0x'.dechex(1<<($bit-1));
}
//gibt den Wert EINES Bits retour
function getbit($val, $bit) {
   return ($val&(0+('0x'.dechex(1<<($bit-1)))))?'1':'0';
}
//gibt den Wert EINES Bits retour
function removebit($val, $bit) {
   if (!getbit($val, $bit)) return $val;
   return $val^(0+('0x'.dechex(1<<($bit-1))));
}

if(!function_exists("file_put_contents")){
    
    /**
     * For compatibility for PHP < 5.0
     * int file_put_contents ( string filename, mixed data [, int flags [, resource context]] )
     */
    function file_put_contents($filename, $data){
        
        $fp = fopen($filename,"w");
        fwrite($fp, $data);
        fclose($fp);
        
    }
    
}

// IP-Adresse
function getip() {
    if (isSet($_SERVER)) {
        if (isSet($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isSet($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
            $realip = getenv( 'HTTP_X_FORWARDED_FOR' );
        } elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
            $realip = getenv( 'HTTP_CLIENT_IP' );
        } else {
            $realip = getenv( 'REMOTE_ADDR' );
        }
    }
    return $realip;
}

// Download a file with fsockopen
function download($url,$target, $port = 80, $timeout = 30){
	// cut away the protocol
	$url_tmp = str_replace("http://","",$url);
	$url_tmp2 = explode("/",$url_tmp);
	// extract the hostname
	$hostname = array_shift($url_tmp2);
	// rebuild the location
	$location = implode("/",$url_tmp2);
	// Open a socket to the host (only http 1.1 os supported)
	$fp = fsockopen($hostname, $port, $errno, $errstr, $timeout);
	if (!$fp) {
	   return false;
	} else {
	    // Build the request and tell the webserver to serve the file with the location ...
	    $out = "GET /" . $location . " HTTP/1.1\r\n";
	    // on the host with the name ...
	    $out .= "Host: " . $hostname . "\r\n";
	    // close after completion of the response
	    $out .= "Connection: Close\r\n\r\n";
	    // Write this commands in the stream 
	    fwrite($fp, $out);
		// Set the start to false because the webserver serves first unnecessary header informations
	   	$start = false;
	   	// A counter
	   	$i = 0;
	   	// Do it until the end of the file
	    while (!feof($fp)) {
	        // Read a line
	        $tmp = fgets($fp);
	        // just start reading data if the startflag is set
		   if ($start == true) {
			   // Write the data to the target file
			   if (fwrite($handle, $tmp) === FALSE) {
						return false;
						break;
			    }
			}
			// Read the first line and check the state of the connection. Just accept 200, otherwise return false and break the whole shit.
			if (ereg("200",$tmp) == false && $i == 0) {
					return false;
					break;
			}
			// If the first character is a newline or a linebreak set the startflag because the header informations are done
	        if ((ord($tmp{0}) == 13 || ord($tmp{0}) == 10) && $start == false) {
	        	 $start = true;
	        	 // Open the target file
	        	 $handle = fopen($target, "w");
	        }
	        $i++;
	    }
	    fclose($fp);
	    if ($start == true) {
	    	// Close the target file
	    	fclose($handle);
	    }
		return true;
	}
}
?>