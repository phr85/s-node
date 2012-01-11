<?php
/**
 * class to handle comma-seperated values
 */
class csv {
    /**
	 * char to seperate the fields
	 */
    var $fieldSeperator = ',';

    /**
     * Char to surround the data
     */
    var $fieldEncloserChar = '"';

    /**
     * Char to escaüe special chairs
     */
    var $fieldEscapeChar = '\\';

    /**
     * Array with the data
     */
    var $data;

    /**
     * CSV-File
     */
    var $file;
    /**
      * Rendered content to use it as fileoutput or print
      */
    var $renderedContent = "";

    function csv($file) {
        $this->file = $file;
    }

    /**
     * Read the data from a textfile
     */
    function read() {
        if (file_exists($this->file)) {
            $this->cleanLinebreaks();
            $handle = fopen($this->file, "r");
            while (($data = fgetcsv($handle, 3000, $this->fieldSeperator, $this->fieldEncloserChar)) !== FALSE) {
            $this->data[] = $data;
            }
            fclose($handle);
        } else {
            XT::log($this->file . " don't exist",__LINE__, __FILE__,XT_ERROR);
        }
    }
    
    /**
     * Clean line breaks
     */
    function cleanLinebreaks() {
        // WINDOWS, MAC, UNIX, don't change the order !!!
        $linebreaks = array("\r\n", "\r", "\n");
        $handle = fopen($this->file, "r");
        $content = fread($handle, filesize($this->file));
        $content = str_replace($linebreaks,"\n", $content);
        fclose($handle);
        $handle = fopen($this->file, "w");
        fwrite($handle, $content);
        fclose($handle);
    }

    /**
     * Preperate the data for the output
     */
    function render() {
        if (is_array($this->data)) {
            foreach($this->data as $data) {
                if (is_array($data)) {
                    $line = "";
                    foreach ($data as $content) {
                        $line .= $this->fieldEncloserChar . $content . $this->fieldEncloserChar . $this->fieldSeperator;
                    }
                    $line = substr($line,0,(strlen($line) - 1));
                }
                $this->renderedContent .= $line .  "\r\n";
            }
        }
    }

    /**
     * Return the rendered csv data
     * @return string Rendered data
     */
    function printData() {
        $this->render();
        return $this->renderedContent;
    }

    /**
     * Return the rendered csv data
     * @return string Rendered data
     */
    function sendData($filename='newsletter') {
        $this->render();
        header("Content-type: txt/csv, charset=UTF-8; encoding=UTF-8");
        header("Content-disposition: " . $filename . "_" . date("d-m-Y") . ".csv");
        header('Content-Disposition: attachment; filename="' . $filename . '_' . date("d-m-Y") . '.csv"');
        echo $this->renderedContent;
    }
}
?>