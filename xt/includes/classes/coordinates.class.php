<?php

class coordinates {
    
    var $_google_base_url = "http://maps.google.com/maps/geo?output=csv";
    var $_google_key = "";
    var $_google_query = "";
    
    var $_address = array(
            "street" => "",
            "postal_code" => "",
            "city" => "",
            "region" => "",
            "country" => "",
    );
    
    function coordinates($key) {
        $this->_google_key = $key;
    }
    
    function set($key, $value) {
        if(isset($this->_address[$key])) {
            $this->_address[$key]= $this->_prepare_input($value);
        }
    }
    
    function query() {
        $this->_build_query();
        $delay = 0;
        $pending = true;
        $return = false;
        while($pending) {
            $answer = explode(",", @file_get_contents($this->_google_query));
            if($answer[0] == 200) {
                $pending = false;
                $return['lat'] = $answer[2];
                $return['lon'] = $answer[3];
            }
            elseif($answer[0] == 620) {
                $delay += 100000;
            }
            else {
                $pending = false;
            }
            usleep($delay);
        }
        return($return);
    }
    
    function _prepare_input($input) {
        return(rawurlencode(trim(str_replace(",", " ", strip_tags($input)))));
    }
    
    function _build_query() {
        $this->_google_query = $this->_google_base_url . "&key=" . $this->_google_key . "&q=" . implode(",", $this->_address);
    }
    
}

?>