<?php
class XT_FileIndexer {

    var $_paths = array(
        'pdftotext' => '/usr/bin/pdftotext',
		'catdoc' => '/usr/bin/catdoc',
		'catppt' => '/usr/bin/catppt',
		'xls2csv' => '/usr/bin/xls2csv',
		'unzip' => '/usr/bin/unzip',
		'sed' => '/usr/bin/sed',
	    );

	var $_supported_extensions = array(
	    'txt' => 1,
	    'php' => 1,
	    'xml' => 1,
	    'htm' => 1,
	    'html' => 1,
	    'sql' => 1,

	    'doc' => 0,
	    'pdf' => 0,
	    'xls' => 0,
	    'sxw' => 0,
	    'ppt' => 0,
	    );

	var $_extension = '';
	var $_output = '';

	function XT_FileIndexer(){
	    error_reporting(1);

	    if(is_file($this->_paths['pdftotext'])){
	        $this->_supported_extensions['pdf'] = 1;
	    }
	    if(is_file($this->_paths['catdoc'])){
	        $this->_supported_extensions['doc'] = 1;
	    }
	    if(is_file($this->_paths['catppt'])){
	        $this->_supported_extensions['ppt'] = 1;
	    }
	    if(is_file($this->_paths['xls2csv'])){
	        $this->_supported_extensions['xls'] = 1;
	    }
	}

    /**
     * Extracts plain text from a given file
     *
     * @param $file Path to the file
     * @param $filename Filename
     * @return String Plain text output
     * @return Boolean false If something failed
     */
	function index($file, $filename){
	    $this->_extension = $this->_getFileExtension($filename);
	    if(@array_key_exists($this->_extension,$this->_supported_extensions)){
	        if($this->_supported_extensions[$this->_extension] == 1){
        	    switch($this->_extension){
        	        case 'pdf':
        	            exec($this->_paths['pdftotext'] . ' -nopgbrk -q ' . $file . ' -', $this->_output);
        	            $this->_output = implode(' ',$this->_output);
        	            return $this->_output;
        	            break;

        	        case 'doc':
        	            exec($this->_paths['catdoc'] . ' ' . $file, $this->_output);
        	            $this->_output = implode(' ',$this->_output);
        	            return $this->_output;
        	            break;

        	        case 'ppt':
        	            exec($this->_paths['catppt'] . ' ' . $file, $this->_output);
        	            $this->_output = implode(' ',$this->_output);
        	            return $this->_output;
        	            break;

        	        case 'xls':
        	            exec($this->_paths['xls2csv'] . ' ' . $file, $this->_output);
        	            $this->_output = implode(' ',$this->_output);
        	            return $this->_output;
        	            break;

        	        case 'sql' || 'txt' || 'php' || 'xml' || 'html' || 'htm' || 'asp' || 'pl':
        	           return file_get_contents($file);
        	           break;
        	    }
	        }
	    }

	    return false;
	}

    /**
     * Gets a filename's extension
     *
     * @param $filename Filename
     * @return String File extension
     */
	function _getFileExtension($filename){
	    $ext = strrchr($filename,'.');
	    return strtolower(substr($ext,1));
	}

}

?>