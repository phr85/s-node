<?php
class XT_Css {
    var $filecontent = "";
    var $filename    = "";
    var $elements    = array();
    
    function XT_Css($filename)
    {
    	$this->filename = $filename;
        
    	if (is_file($filename) && is_readable($filename)) {
    		$handle = fopen ($filename, "r");
            while (!feof($handle)) {
               $buffer = fgets($handle, 4096);
            }
            fclose ($handle);
    	}
    	
    	echo '<pre>' . print_r($this->parse(), true) . '</pre>';
    }
    
    function parse()
    {
        $data = array();
    	$lines = $this->tokenize();
    	$buffer= "";
    	
    	$inside_comment = false;
    	$inside_element = false;
    	
    	$i = 0;
    	
    	foreach ($lines as $line) {
    		
    	}
    	return $lines;
    }
    
    function tokenize()
    {
    	return explode("\n", $this->filecontent);
    }
    
    function beginsWith($haystack, $needle) {
        if (substr($haystack, 0, strlen($needle)) == $needle) {
        	return true;
        }
        else {
        	return false;
        }
    }
}
?>