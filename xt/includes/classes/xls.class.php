<?php

/**
 * xls.class.php
 *
 * Distributed under the GNU Lesser General Public License (LGPL v3)
 * (http://www.gnu.org/licenses/lgpl.html)
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 * Author: iframe AG, Dominik Zogg <dominik.zogg at iframe.ch>
 *
 */

class xls {

    /* private string filename */
    var $_filename = "";

    /* private array data */
    var $_data = array();

    /* private string renderedContent */
    var $_renderedContent = "";

    /* __construct */
    function xls($filename) {
        $this->_filename = substr($filename, 0 , strpos($filename, "."));
    }

    /* public function addData() */
    function addData($data) {
        if(is_array($data)) {
            $this->_data = $data;
            $this->renderContent();
        }
    }

    /* private function renderContent() */
    function renderContent() {
        $this->_renderedContent = "";
        $badsigns = array("\t", "\r", "\n");
        $goodsigns = array(" ", "", "");
        foreach($this->_data as $row) {
            $rowstring = "";
            foreach($row as $field) {
                $rowstring .= str_replace($badsigns, $goodsigns, utf8_decode(stripslashes($field))) . "\t";
            }
            $this->_renderedContent .= substr($rowstring, 0, -1) . "\r\n";
        }
    }

    /* public function sendData() */
    function sendData() {
        header("Content-type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' .  $this->_filename . '_' . date("d-m-Y") . '.xls"');
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $this->_renderedContent;
    }

}


?>