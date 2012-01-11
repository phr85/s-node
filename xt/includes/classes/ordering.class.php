<?php
class XT_Order {

    var $fields = array();
    var $direction = 'ASC';
    var $default = '';
    var $baseid = 0;
    var $sortlistener = "";
    var $name = "default";
    // orderdirection 1 = ASC -1 = DESC

    /**
     * Initialisiere sortierbare Felder
     *
     * @param fields string comma separated list of fields with prefixes (i.e. img.id,data.field,data.email,img.size)
     * @param default string default ordering field
     * @param direction string default ordering field
     */

    function XT_Order($fields,$default="",$direction=1,$name="default"){

        $this->name = $name;
        $this->fields = explode(",", $fields);
        $this->baseid = "x" . $GLOBALS['plugin']->_baseid;
        $this->direction = $direction;
        if(!$_SESSION[$this->baseid]['xt_order'][$this->name]['direction']){
            $_SESSION[$this->baseid]['xt_order'][$this->name]['direction']=$direction;
        }
        if($default==""){
            $default = $this->fields[0];
        }
        $this->default = $default;

        if(!$_SESSION[$this->baseid]['xt_order'][$this->name]['field']){
            $_SESSION[$this->baseid]['xt_order'][$this->name]['field'] = $default;
        }
    }

    /**
     * Reset ordering
     *
     */
    function reset(){
        $_SESSION[$this->baseid]['xt_order'][$this->name]['direction'] = $this->direction;
        $_SESSION[$this->baseid]['xt_order'][$this->name]['field'] = $this->default;
    }

    function setListener($orderby,$ascdesc="ascdesc"){

        if(XT::getValue($orderby)!="" && in_array(XT::getValue($orderby),$this->fields)){
            // Orderdirection
            if($_SESSION[$this->baseid]['xt_order'][$this->name]['field'] == XT::getValue($orderby)){
                $_SESSION[$this->baseid]['xt_order'][$this->name]['direction'] = $_SESSION[$this->baseid]['xt_order'][$this->name]['direction']*-1;
            }else{
                $_SESSION[$this->baseid]['xt_order'][$this->name]['direction'] = $this->direction;
            }
            $_SESSION[$this->baseid]['xt_order'][$this->name]['field'] = XT::getValue($orderby);
        }

        if(XT::getValue($ascdesc)!=""){
            if(XT::getValue($ascdesc)=="ASC"){
                $_SESSION[$this->baseid]['xt_order'][$this->name]['direction'] = 1;
            }else {
                $_SESSION[$this->baseid]['xt_order'][$this->name]['direction'] = -1;
            }
        }
        $this->sortlistener = $orderby;
        return true;
    }

    /**
     * Set Field and direction
     *
     */
    function set($field,$direction=""){
        if(!in_array($field,$this->fields)){
            return false;
        }
        if($field!="" && in_array($field,$this->fields)){
            // Orderdirection
            if($_SESSION[$this->baseid]['xt_order'][$this->name]['field'] == $field){
                $_SESSION[$this->baseid]['xt_order'][$this->name]['direction'] = $_SESSION[$this->baseid]['xt_order'][$this->name]['direction']*-1;
            }else{
                $_SESSION[$this->baseid]['xt_order'][$this->name]['direction'] = $this->direction;
            }
            $_SESSION[$this->baseid]['xt_order'][$this->name]['field'] = $field;
        }
        if($direction){
            $_SESSION[$this->baseid]['xt_order'][$this->name]['direction'] = $direction;
        }
        $_SESSION[$this->baseid]['xt_order'][$this->name]['field'] = $field;
        return true;
    }


    /**
     * get orderstring
     *
     */
    function get($full=true){
        if($full){
            $retval = "ORDER by ";
        }
        $retval.= $_SESSION[$this->baseid]['xt_order'][$this->name]['field'] . " ";
        if($_SESSION[$this->baseid]['xt_order'][$this->name]['direction']==1){
            $retval .="ASC";
        }else{
            $retval .="DESC";
        }
        $this->getLinks();
        return $retval;
    }

    function getLinks(){
        foreach ($this->fields as $key => $value) {
            $linklist[$key]['sortlistener'] = $this->sortlistener;
            $linklist[$key]['value'] =$value;
            if($_SESSION[$this->baseid]['xt_order'][$this->name]['field'] == $value){
                $linklist[$key]['selected'] = true;
                $linklist[$key]['direction'] .= $_SESSION[$this->baseid]['xt_order'][$this->name]['direction'];
            }else{
                $linklist[$key]['selected'] = false;
                $linklist[$key]['direction'] = $this->direction;
            }
            if($linklist[$key]['direction']==1){
                if($linklist[$key]['selected']==true){
                    $linklist[$key]['icon']= "layout_north_sel.png";
                }else{
                    $linklist[$key]['icon']= "layout_north.png";
                }
            }else{
                if($linklist[$key]['selected']==true){
                    $linklist[$key]['icon']= "layout_south_sel.png";
                }else{
                    $linklist[$key]['icon']= "layout_south.png";
                }

            }
        }
        if(!empty($this->sortlistener)){
            XT::assign($this->sortlistener,$linklist);
        }else{
            XT::assign("sort",$linklist);
        }

    }
}
?>